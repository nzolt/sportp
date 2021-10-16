<?php

namespace App\Facade;

use App\Exceptions\InvalidDateException;
use App\Service\RentCalculator;
use App\Exceptions\InvalidFileException;

class RentCalculatorFacade
{
    /**
     * @param string $filenameIn
     * @param string $filenameOut
     * @param bool $details
     * @param string $return
     * @return array
     */
    public static function calculate(string $filenameIn, string $filenameOut = '', bool $details = false, string $return = ''): array
    {
        $rentCalculator = new RentCalculator();
        try {
            return $rentCalculator->calculate($filenameIn, $filenameOut, $details, $return);
        } catch (InvalidFileException $e){
            return [$e->getCode(), $e->getMessage()];
        } catch (InvalidDateException $e){
            return [$e->getCode(), $e->getMessage()];
        }
    }
}