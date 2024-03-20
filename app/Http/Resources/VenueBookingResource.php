<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VenueBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        if (isset($data['venue']) && !is_null($data['venue'])) {
            $data['venue']['banner'] = $data['venue']['upload_photo'][0]['url'];
            unset($data['venue']['upload_photo']);
            unset($data['venue']['media']);
        }
        if (isset($data['sport']) && !is_null($data['sport'])) {
            unset($data['sport']['media']);
        }
        if (isset($data['event_booking']) && !is_null($data['event_booking'])) {
            unset($data['event_booking']['media']);
        }
        return $data;
    }
}
