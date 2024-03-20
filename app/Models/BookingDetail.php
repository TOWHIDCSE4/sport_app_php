<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use \DateTimeInterface;
use Spatie\MediaLibrary\InteractsWithMedia;

class BookingDetail extends Model
{
    use HasFactory;
    use InteractsWithMedia;
    use HasAdvancedFilter;

    public $table = 'booking_detail';

    protected $fillable = [
        'id',
        'booking_id',
        'venue_id',
        'start_time',
        'end_time',
    ];

    public $orderable = [
        'id',
        'booking_id',
        'venue_id',
        'start_time',
        'end_time',
    ];

    public $filterable = [
        'id',
        'booking_id',
        'venue_id',
        'start_time',
        'end_time',
    ];
    protected $dates = ['created_at', 'updated_at'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
