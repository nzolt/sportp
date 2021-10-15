<?php

namespace App\Helpers;

use App\Exceptions\InvalidDateException;
use DateTime;
use DateInterval;

class DateHelper
{
    /**
     * @param array $cakes
     * @return array
     */
    public static function sortByDate(array $rents, string $key): array
    {
        usort($rents, # Order by dates ascending
            function ($a, $b) use (&$key) {
                return $a[$key] > $b[$key];
            }
        );
        return $rents;
    }
}