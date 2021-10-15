<?php

namespace Tests\unit\Provider\Helpers;

class DataProvider
{
    public static function provideWorkingDaysData()
    {
        return [
            ["-07-23", "-07-21"],
            ["-07-22", "-07-20"],
            ["-09-07", "-09-04"],
            ["-06-29", "-06-25"],
            ["-07-21", "-07-19"],
            ["-07-14", "-07-12"],
            ["-09-07", "-09-05"],
        ];
    }
}