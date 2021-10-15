<?php

namespace App\Service;

abstract class RentCalculatorAbstract
{
    public function formatToFile(array $cakeDates): array
    {
        $out = [];
        foreach ($cakeDates as $type => $row) {
            if (is_array($row) && count($row) > 0) {
                foreach ($row as $names => $date) {
                    if($type == 'Big cakes'){
                        $out[] = [
                            $date, 0, 1, $names
                        ];
                    } else {
                        $out[] = [
                            $date, 1, 0, $names
                        ];
                    }
                }
            }
        }

        usort($out, # Order by dates ascending
            function ($a, $b) {
                return $a[0] > $b[0];
            }
        );

        return $out;
    }

    public function writeToFile(array $data, string $fileOut): void
    {
        $file = fopen($fileOut, 'w');
        foreach ($data as $fields) {
            fputcsv($file, $fields);
        }

        fclose($file);
    }
}