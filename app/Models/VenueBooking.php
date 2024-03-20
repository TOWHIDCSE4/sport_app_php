<?php

namespace App\Models;

use App\Enums\VenueStatus;
use App\Enums\VenueBookingStatus;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VenueBooking extends Model
{
    use HasFactory;
    use InteractsWithMedia;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'venue_booking';

    protected $fillable = [
        'id',
        'venue_id',
        'creator_id',
        'venue_id',
        'event_id',
        'response',
        'court_id',
        'start_date',
        'end_date',
        'total_time',
        'cost',
        'code',
        'court_name',
        'address',
        'price',
        'sport_id',
        'currency',
    ];

    public $orderable = [
        'id',
        'venue_id',
        'response',
        'event.title',
        'created_at',
        'sport.name',
        'code',
        'start_date',
        'end_date',
    ];

    protected $dates = ['created_at', 'updated_at', 'cancel_at', 'deleted_at'];

    public $filterable = [
        'id',
        'response',
        'event.title',
        'sport.name',
        'code',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'response' => VenueBookingStatus::class,
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function booking_detail()
    {
        return $this->belongsTo(BookingDetail::class, 'id', 'booking_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class)->where(
            'status',
            VenueStatus::active()
        );
    }
    public function schedule()
    {
        return $this->hasMany(BookingDetail::class, 'booking_id');
    }

    public function event_booking()
    {
        return $this->belongsTo(Event::class, 'id', 'venue_book_id');
    }
}
