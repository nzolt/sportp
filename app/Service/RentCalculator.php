<?php

namespace App\Service;

use App\Exceptions\InvalidDataException;
use App\Validators\DateValidator;
use App\Exceptions\InvalidFileException;
use App\Helpers\DateHelper;
use DateTime;

class RentCalculator extends RentCalculatorAbstract implements RentCalculatorInterface
{
    /**
     * @param string $filenameIn
     * @param string $filenameOut
     * @param array $details
     * @param string $return
     * @return array
     * @throws InvalidFileException
     */
    public function calculate(string $filenameIn, string $filenameOut = '', bool $details = false, string $return = ''): array
    {
        $rents = $this->loadData($filenameIn);
        list($detailsByBikes, $totalAvg) = $this->processData($rents, $details);

        // Prepare details
        $rentCli = [];
        if($details){
            foreach($detailsByBikes as $bId => $bike){
                $rentCli[] = [
                    "Bike ID" => $bId,
                    "Avg rent time" => $bike,
                ];
            }
        }

        if($return == 'Yes' && $filenameOut != '') {
            $this->writeToFile($rentCli, $filenameOut);
        }

        return ['details' => $rentCli, 'totalAvg' => $totalAvg];
    }

    /**
     * @param string $filenameIn
     * @return array
     * @throws InvalidFileException
     */
    public function loadData(string $filenameIn): array
    {
        $csvMimes = array('text/csv', 'text/plain');
        if(!file_exists($filenameIn) || !in_array(mime_content_type($filenameIn), $csvMimes)){
            throw new InvalidFileException();
        }
        $rents = [];
        $handle = fopen($filenameIn,'r');
        while ( $data = fgetcsv($handle) ) {
            if(!empty($data[3])) {
                if (DateValidator::validateDate($data[3])) { // If no return DT, skipp
                    $rents[$data[1]][] = ['in' => $data[2], 'out' => $data[3]];
                    // We don't store the full DateTime object to save memory space.
                    // Anyway, we need current year.
                }
            }
        }

        return $rents;
    }

    /**
     * @param array $rents
     * @param bool $details
     * @return array
     */
    public function processData(array $rents, bool $details = false): array
    {
        $totalRentTimes = [];
        $rentAvgByBikes = [];
        $rentAvgByBike = [];
        foreach($rents as $bId => $bike){
            $rentTime = $this->processRents($bike);
            if($rentTime){
                $rentTimes[$bId] = $rentTime;
            }
        }

        foreach ($rentTimes as $bId => $bikeRentTimes){
            //$rentAvgByBike[$bId] = array_sum($bikeRentTimes)/count($bikeRentTimes);
            $totalRentTimes = array_merge($totalRentTimes, $bikeRentTimes);
            if($details){
                $rentAvgByBikes[$bId] = $this->getAvg($bikeRentTimes)->format('%H:%i:%s');
            }
        }

        return [
            $rentAvgByBikes,
            $this->getAvg($totalRentTimes)->format('%H:%i:%s')
            ];
    }

    /**
     * @param array $rents
     * @return array
     */
    public function processRents(array $rents): array
    {
        $rents = DateHelper::sortByDate($rents, 'out'); # Order by return time. Overwrite the array, we don't need the original

        $times = [];
        foreach($rents as $rent){
            $in = next($rents);
            if($in) {
                $nextIn = date_create($in['in']);
                $out = date_create($rent['out']);
                $times[] = $nextIn->getTimestamp() - $out->getTimestamp();
            }
        }

        return $times;
    }

    /**
     * @param array $rentsTotal
     * @return \DateInterval
     */
    protected function getAvg(array $rentAvg): \DateInterval
    {
        $rentAvgTotal = round(array_sum($rentAvg)/count($rentAvg));
        $rentDateTimeBase = new DateTime();
        $rentDateTimeBase->setTimestamp(0);
        $rentDateTimeAvg = new DateTime();
        $rentDateTimeAvg->setTimestamp($rentAvgTotal);
        return date_diff($rentDateTimeBase, $rentDateTimeAvg);
    }
}