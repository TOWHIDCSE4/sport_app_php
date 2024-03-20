<?php

namespace App\Http\Controllers\API\Venue;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Court;
use App\Models\BookMark;
use App\Models\VenueBooking;
use App\Models\BookingDetail;
use App\Http\Resources\VenueResource;
use App\Http\Resources\VenueBookingResource;
use Validator;
use App\Enums\VenueBookingStatus;
use App\Enums\VenueStatus;

define('TYPE_VENUE', 'venue');

class VenueController extends BaseController
{
    public function getAllVenue(Request $request)
    {
        $input = $request->all();
        $limit = isset($input['perpage']) ? $input['perpage'] : 20;
        $q = $request->has('q') ? $input['q'] : null;
        $type = $request->has('type') ? $input['type'] : null;
        $sport_id = $request->has('sport_id') ? $input['sport_id'] : null;
        $country_id = $request->has('country_id') ? $input['country_id'] : null;

        $validator = Validator::make($request->all(), [
            'type' => 'nullable|sometimes|numeric',
            'country_id' => 'nullable|sometimes',
            'sport_id' => 'nullable|sometimes',
        ]);
        $listSportId = !is_null($sport_id)
            ? array_map('intval', explode(',', $sport_id))
            : null;
        $listCountryId = !is_null($country_id)
            ? array_map('intval', explode(',', $country_id))
            : null;
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error);
        }
        $results = null;
        try {
            $results = Venue::with([
                'country:id,name,code,phone_code',
                'type:id,code,name',
                'owner:id,first_name,last_name,phone,gender,birth_date',
                'court:id,venue_id,sport_id,name,price,weight,status',
            ])
                ->where(function ($query) use (
                    $q,
                    $type,
                    $listCountryId,
                    $listSportId
                ) {
                    if (!is_null($q)) {
                        $query->where('name', 'LIKE', '%' . $q . '%');
                    }
                    if (!is_null($type)) {
                        $query->where('type', $type);
                    }
                    if (!is_null($listCountryId)) {
                        $query->whereIn('country_id', $listCountryId);
                    }
                    if (!is_null($listSportId)) {
                        $query->whereHas('court', function ($q) use (
                            $listSportId
                        ) {
                            if (!is_null($listSportId)) {
                                $q->whereIn('sport_id', $listSportId);
                            }
                        });
                    }
                })
                ->withCount('court')
                ->where('status', VenueStatus::active())
                ->simplePaginate($limit);
        } catch (\Throwable $th) {
            return $this->sendError('An error occurred.' . $th);
        }
        return $this->sendResponse(
            VenueResource::collection($results),
            'success'
        );
    }

    public function getDetailVenue($id)
    {
        $user_id = auth()->user()->id;
        $results = [];
        try {
            $results = Venue::with([
                'country:id,name,code,phone_code',
                'type:id,code,name',
                'owner:id,first_name,last_name,phone,gender,birth_date',
                'workdays:name,code',
                'court:id,sport_id,name,price,weight,status',
            ])
                ->withCount('court')
                ->where('status', VenueStatus::active())
                ->find($id);

            if (empty($results)) {
                return $this->sendError('Venue not found.');
            }
            $existBookmark = BookMark::where('user_id', $user_id)
                ->where('target_id', $results->id)
                ->where('target_type', TYPE_VENUE)
                ->first();
            $results->is_bookmark = false;
            if (!empty($existBookmark)) {
                $results->is_bookmark = true;
            }
        } catch (\Throwable $th) {
            return $this->sendError('An error occurred.' . $th);
        }

        return $this->sendResponse(new VenueResource($results), 'success');
    }

    public function createVenueBooking(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'venue_id' => 'required|numeric',
            'court_id' => 'required|numeric',
            'schedule' => 'required|array',
            'total_time' => 'required',
            'price' => 'required|between:0,99.99',
            'cost' => 'required|between:0,99.99',
            'currency_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error);
        }
        $venue_booking = null;
        try {
            // check venue
            $existVenue = Venue::where('status', VenueStatus::active())
                ->where('id', $input['venue_id'])
                ->first();
            if (empty($existVenue)) {
                return $this->sendError('Venue not found.');
            }
            // check court
            $existCourt = Court::where('id', $input['court_id'])
                ->where('venue_id', $input['venue_id'])
                ->first();
            if (empty($existCourt)) {
                return $this->sendError('Court not of the venue.');
            }

            // validate schedules
            $schedules = $input['schedule'];
            $sum_total_time = 0;
            $start_date_least = isset($schedules[0]['start'])
                ? date('Y-m-d H:i:s', strtotime($schedules[0]['start']))
                : '';
            $end_date_least = isset($schedules[0]['end'])
                ? date('Y-m-d H:i:s', strtotime($schedules[0]['end']))
                : '';
            if (count($schedules) > 0) {
                foreach ($schedules as $item) {
                    if (!empty($item['start']) && !empty($item['end'])) {
                        try {
                            $start_date = date(
                                'Y-m-d H:i:s',
                                strtotime($item['start'])
                            );
                            $end_date = date(
                                'Y-m-d H:i:s',
                                strtotime($item['end'])
                            );
                            if (strtotime($start_date) > strtotime($end_date)) {
                                return $this->sendError(
                                    'start date is greater than end date'
                                );
                            }
                            if (
                                date('Y-m-d', strtotime($item['start'])) !=
                                date('Y-m-d', strtotime($item['end']))
                            ) {
                                return $this->sendError('must be same day!');
                            }

                            $existBooking = VenueBooking::where(
                                'venue_id',
                                $input['venue_id']
                            )
                                ->where('court_id', $input['court_id'])
                                ->whereHas('booking_detail', function ($q) use (
                                    $start_date,
                                    $end_date
                                ) {
                                    $q
                                        ->where(function ($query) use (
                                            $start_date
                                        ) {
                                            $query->where(
                                                'start_time',
                                                '<=',
                                                $start_date
                                            );
                                            $query->where(
                                                'end_time',
                                                '>=',
                                                $start_date
                                            );
                                        })
                                        ->orWhere(function ($query) use (
                                            $end_date
                                        ) {
                                            $query->where(
                                                'start_time',
                                                '<=',
                                                $end_date
                                            );
                                            $query->where(
                                                'end_time',
                                                '>=',
                                                $end_date
                                            );
                                        });
                                })
                                ->first();
                            if (!empty($existBooking)) {
                                return $this->sendError(
                                    'Booking schedule overlapped with venue\'s schedules'
                                );
                            }

                            $sum_total_time +=
                                strtotime($item['end']) -
                                strtotime($item['start']);
                            if (
                                strtotime($start_date_least) >
                                strtotime($start_date)
                            ) {
                                $start_date_least = $start_date;
                            }
                            if (
                                strtotime($end_date_least) <
                                strtotime($end_date)
                            ) {
                                $end_date_least = $end_date;
                            }
                        } catch (\Throwable $th) {
                            throw $th;
                        }
                    }
                }
            }

            // validate price
            if ($input['price'] != $existCourt->price) {
                return $this->sendError('Price incorrect.');
            }
            // validate total hour
            if ($input['total_time'] != $sum_total_time) {
                return $this->sendError('total time incorrect.');
            }

            // validate cost
            if (
                $existCourt->price * ($sum_total_time / 3600) !=
                $input['cost']
            ) {
                return $this->sendError('Cost incorrect.');
            }

            // insert venue
            $dataInsert = [
                'venue_id' => $input['venue_id'],
                'court_id' => $input['court_id'],
                'creator_id' => auth()->user()->id,
                'response' => VenueBookingStatus::pending(),
                'start_date' => $start_date_least,
                'end_date' => $end_date_least,
                'total_time' => $sum_total_time,
                'code' => $this->generateRandomString(),
                'cost' => $input['cost'],
                'court_name' => $existCourt->name,
                'address' => $existVenue->address,
                'price' => $existCourt->price,
                'sport_id' => $existCourt->sport_id,
                'currency' => $existVenue->currency,
            ];
            $venue_booking = VenueBooking::create($dataInsert);
            if (!empty($venue_booking)) {
                foreach ($schedules as $key => $item) {
                    BookingDetail::create([
                        'booking_id' => $venue_booking->id,
                        'venue_id' => $input['venue_id'],
                        'start_time' => date(
                            'Y-m-d H:i:s',
                            strtotime($item['start'])
                        ),
                        'end_time' => date(
                            'Y-m-d H:i:s',
                            strtotime($item['end'])
                        ),
                    ]);
                }
            }

            // Update popularity counter for venue
            $venue_booking_total = VenueBooking::where(
                'venue_id',
                $input['venue_id']
            )
                ->where('response', '!=', VenueBookingStatus::canceled())
                ->get()
                ->toArray();
            if (count($venue_booking_total) > 0) {
                $existVenue->update([
                    'popularity' => count($venue_booking_total),
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $this->sendResponse(
            new VenueBookingResource($venue_booking),
            'success'
        );
    }

    function generateRandomString($length = 10)
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getAllVenueBooking(Request $request)
    {
        $input = $request->all();
        $limit = isset($input['perpage']) ? $input['perpage'] : 20;
        $user_id = auth()->user()->id;
        $is_ready = isset($input['is_ready'])
            ? (bool) $input['is_ready']
            : false;

        $results = null;
        try {
            $results = VenueBooking::with([
                'venue:id,name,address,email,start_open_time,end_open_time,popularity,start_price,end_price,country_id',
                'court:id,sport_id,name,price,weight,status',
                'venue.country:id,name,code,phone_code',
            ])
                ->where('venue_booking.creator_id', $user_id)
                ->where('end_date', '>=', date('Y-m-d H:i:s'))
                ->where(function ($q) use ($is_ready) {
                    if ($is_ready === true) {
                        $q->where('response', VenueBookingStatus::booked());
                        $q->whereDoesntHave('event_booking');
                    }
                })
                ->simplePaginate($limit);
        } catch (\Throwable $th) {
            return $this->sendError('An error occurred.' . $th);
        }
        return $this->sendResponse(
            VenueBookingResource::collection($results),
            'success'
        );
    }

    public function getDetailVenueBooking($id)
    {
        $user_id = auth()->user()->id;
        $results = null;
        try {
            $results = VenueBooking::with([
                'venue',
                'court:id,sport_id,name,price,weight,status',
                'venue.country:id,name,code,phone_code',
                'currency:id,name,code,symbol',
                'sport:id,name,description,code,max_player_per_team,min_player_per_team',
                'schedule:id,booking_id,venue_id,start_time,end_time',
                'event_booking:id,venue_book_id,title,event_type,application_type,location,start_date_time,end_date_time',
            ])
                ->where('id', $id)
                ->first();
        } catch (\Throwable $th) {
            return $this->sendError('An error occurred.' . $th);
        }
        return $this->sendResponse(
            new VenueBookingResource($results),
            'success'
        );
    }
}
