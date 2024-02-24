<?php

namespace App\Enums;


enum WeekDays: int
{
    case Saturday = 1;
    case Sunday = 2;
    case Monday = 3;
    case Tuesday = 4;
    case Wednesday = 4;
    case Thursday = 6;

    static function byName($name)
    {
        return match ($name) {
            'Saturday' => 1,
            'Sunday' => 2,
            'Monday' => 3,
            'Tuesday' => 4,
            'Wednesday' => 5,
            'Thursday' => 6,
        };
    }
}
