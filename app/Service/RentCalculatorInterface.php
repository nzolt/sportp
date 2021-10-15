<?php

namespace App\Service;

interface RentCalculatorInterface
{
    /**
     * @param string $filenameIn
     * @param string $filenameOut
     * @param array $details
     * @param string $return
     * @return array
     */
    public function calculate(string $filenameIn, string $filenameOut = '', array $details = [], string $return = ''): array;

    /**
     * @param array $rents
     * @param bool $details
     * @return array
     */
    public function processData(array $rents, bool $details = false): array;

    /**
     * @param array $cakeDates
     * @return array
     */
    public function formatToFile(array $cakeDates): array;

    /**
     * @param array $data
     * @param string $fileOut
     */
    public function writeToFile(array $data, string $fileOut): void;
}