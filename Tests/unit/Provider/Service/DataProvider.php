<?php


namespace Tests\unit\Provider\Service;


class DataProvider
{
	public static function provideProcessData()
	{
		return [
            [
                array (
                    102 =>
                        array (
                            0 =>
                                array (
                                    'in' => '',
                                    'out' => '20200304T12:20:00',
                                ),
                            1 =>
                                array (
                                    'in' => '20200304T13:04:00',
                                    'out' => '20200304T13:25:32',
                                ),
                            2 =>
                                array (
                                    'in' => '20200304T13:34:00',
                                    'out' => '20200304T14:25:32',
                                ),
                            3 =>
                                array (
                                    'in' => '20200304T14:44:00',
                                    'out' => '20200304T15:20:32',
                                ),
                            4 =>
                                array (
                                    'in' => '20200304T16:14:00',
                                    'out' => '20200304T16:25:32',
                                ),
                            5 =>
                                array (
                                    'in' => '20200304T16:40:00',
                                    'out' => '20200304T16:55:32',
                                ),
                        ),
                    34 =>
                        array (
                            0 =>
                                array (
                                    'in' => '',
                                    'out' => '20200301T05:15:08',
                                ),
                        ),
                ),
                '00:27:46'
            ]
        ];
	}
}