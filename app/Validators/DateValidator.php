<?php


namespace App\Validators;

use App\Exceptions\InvalidDateException;

/**
 * Class DateValidator
 * @package App\Data
 */
class DateValidator
{
    /**
     * @param string $date
     * @param string $format
     * @return bool
     * @throws InvalidDateException
     */
    public static function validateDate($date): bool
    {
        if(self::validateFormat($date) && date_create($date)){
            return true;
        } else {
            throw new InvalidDateException('The date is invalid!');
        }

        return false;
    }

    /**
     * Validate string DateTime format "Y-m-dTH:i:s"
     * @param string $date
     * @return bool
     */
    public static function validateFormat(string $date): bool
    {
        # We validate just one format. Can be changed to more generic if needed.
        if (preg_match("/(\d{4})(\d{2})(\d{2})T(\d{2}):(\d{2}):(\d{2})/", $date)) {
            return true;
        }

        return false;
    }
}