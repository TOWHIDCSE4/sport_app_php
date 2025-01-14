<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * Class GenderEnum
 * @package App\Enums
 *
 * @method static self pending()
 * @method static self accepted()
 * @method static self declined()
 * @method static self booked()
 * @method static self canceled()
 */
final class VenueBookingStatus extends Enum
{
    /**
     * @return int[]
     */
    #[ArrayShape([
        'pending' => 'integer',
        'accepted' => 'integer',
        'declined' => 'integer',
        'booked' => 'integer',
        'canceled' => 'integer'
    ])] protected static function values(): array
    {
        return [
            'pending' => 0,
            'accepted' => 1,
            'declined' => 2,
            'booked' => 3,
            'canceled' => 4,
        ];
    }

    /**
     * @return array
     */
    #[ArrayShape([
        'pending' => 'string',
        'accepted' => 'string',
        'declined' => 'string',
        'booked' => 'string',
        'canceled' => 'string',
    ])] protected static function labels(): array
    {
        return [
            'pending' => __('enum.reservation.pending'),
            'accepted' => __('enum.reservation.accepted'),
            'declined' => __('enum.reservation.declined'),
            'booked' => __('enum.reservation.booked'),
            'canceled' => __('enum.reservation.canceled'),
        ];
    }
}
