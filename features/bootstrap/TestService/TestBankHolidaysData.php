<?php

namespace TestService;

class TestBankHolidaysData
{
    public const DATETIME_FORMAT = 'Y-m-d';
    public const BANK_HOLIDAY = '2019-12-25';
    public const NON_BANK_HOLIDAY = '2019-04-04';
    public const REGIONAL_BANK_HOLIDAY = '2019-06-06';
    public const BANK_HOLIDAY_RANGE_FROM = '2019-11-11';
    public const BANK_HOLIDAY_RANGE_TO = '2019-12-29';
    public const NON_BANK_HOLIDAY_RANGE_FROM = '2019-03-04';
    public const NON_BANK_HOLIDAY_RANGE_TO = '2019-05-06';


    public static function getBankHolidaysSortedByRegion()
    {
        return [
            'england-and-wales' => [
                '2019-06-06' => [
                    'date'  => '2019-06-06',
                    'title' => 'REGION TEST 1',
                ],
                '2019-12-24' => [
                    'date'  => '2019-12-24',
                    'title' => 'REGION TEST 2',
                ],
                '2019-12-25' => [
                    'date'  => '2019-12-25',
                    'title' => 'Christmas Day',
                ],
                '2019-12-26' => [
                    'date'  => '2019-12-26',
                    'title' => 'Boxing Day',
                ],
                '2020-01-01' => [
                    'date'  => '2020-01-01',
                    'title' => 'New Year’s Day',
                ],
            ],
            'scotland'          => [
                '2019-12-25' => [
                    'date'  => '2019-12-25',
                    'title' => 'Christmas Day',
                ],
                '2019-12-26' => [
                    'date'  => '2019-12-26',
                    'title' => 'Boxing Day',
                ],
                '2020-01-01' => [
                    'date'  => '2020-01-01',
                    'title' => 'New Year’s Day',
                ],
            ],
        ];
    }

    public static function getBankHolidaysSortedByDate()
    {
        return [
            '2019-06-06' => [
                'date'  => '2019-06-06',
                'title' => 'REGION TEST 1',
            ],
            '2019-12-24' => [
                'date'  => '2019-12-24',
                'title' => 'REGION TEST 2',
            ],
            '2019-12-25' => [
                'date'  => '2019-12-25',
                'title' => 'Christmas Day',
            ],
            '2019-12-26' => [
                'date'  => '2019-12-26',
                'title' => 'Boxing Day',
            ],
            '2020-01-01' => [
                'date'  => '2020-01-01',
                'title' => 'New Year’s Day',
            ],
        ];
    }

    public static function getExpectedResultForDateRange()
    {
        return [
            '2019-12-24' => '2019-12-24',
            '2019-12-25' => '2019-12-25',
            '2019-12-26' => '2019-12-26',
        ];
    }

    public static function getExpectedResultForDateRangeWithRegionWithoutAdditionalBankHoliday()
    {
        return [
            '2019-12-25' => '2019-12-25',
            '2019-12-26' => '2019-12-26',
        ];
    }
}
