<?php

namespace TestService;

class TestBankHolidaysData
{
    public const DATETIME_FORMAT = 'Y-m-d';
    public const BANK_HOLIDAY = '2019-12-25';
    public const BANK_HOLIDAY_TITLE = 'Christmas Day';
    public const NON_BANK_HOLIDAY = '2019-04-04';
    public const BANK_HOLIDAY_RANGE_FROM = '2019-11-11';
    public const BANK_HOLIDAY_RANGE_TO = '2019-12-29';
    public const NON_BANK_HOLIDAY_RANGE_FROM = '2019-03-04';
    public const NON_BANK_HOLIDAY_RANGE_TO = '2019-05-06';


    public static function getBankHolidays()
    {
        return [
            'england-and-wales_2019-06-06' => [
                'region' => 'england-and-wales',
                'date'   => '2019-06-06',
                'title'  => 'REGION TEST 1',
            ],
            'england-and-wales_2019-12-24' => [
                'region' => 'england-and-wales',
                'date'   => '2019-12-24',
                'title'  => 'REGION TEST 2',
            ],
            'england-and-wales_2019-12-25' => [
                'region' => 'england-and-wales',
                'date'   => '2019-12-25',
                'title'  => 'Christmas Day',
            ],
            'england-and-wales_2019-12-26' => [
                'region' => 'england-and-wales',
                'date'   => '2019-12-26',
                'title'  => 'Boxing Day',
            ],
            'england-and-wales_2020-01-01' => [
                'region' => 'england-and-wales',
                'date'   => '2020-01-01',
                'title'  => 'New Year’s Day',
            ],
            'scotland_2019-12-25'          => [
                'region' => 'scotland',
                'date'   => '2019-12-25',
                'title'  => 'Christmas Day',
            ],
            'scotland_2019-12-26'          => [
                'region' => 'scotland',
                'date'   => '2019-12-26',
                'title'  => 'Boxing Day',
            ],
            'scotland_2020-01-01'          => [
                'region' => 'scotland',
                'date'   => '2020-01-01',
                'title'  => 'New Year’s Day',
            ],
        ];
    }

    public static function getExpectedResultForDateRange()
    {
        return [
            [
                'region' => 'england-and-wales',
                'date'   => '2019-12-24',
                'title'  => 'REGION TEST 2',
            ],
            [
                'region' => 'england-and-wales',
                'date'   => '2019-12-25',
                'title'  => 'Christmas Day',
            ],
            [
                'region' => 'england-and-wales',
                'date'   => '2019-12-26',
                'title'  => 'Boxing Day',
            ],
            [
                'region' => 'scotland',
                'date'   => '2019-12-25',
                'title'  => 'Christmas Day',
            ],
            [
                'region' => 'scotland',
                'date'   => '2019-12-26',
                'title'  => 'Boxing Day',
            ],
        ];
    }

    public static function getExpectedResultForDateRangeWithRegion()
    {
        return [
            [
                'region' => 'england-and-wales',
                'date'   => '2019-12-24',
                'title'  => 'REGION TEST 2',
            ],
            [
                'region' => 'england-and-wales',
                'date'   => '2019-12-25',
                'title'  => 'Christmas Day',
            ],
            [
                'region' => 'england-and-wales',
                'date'   => '2019-12-26',
                'title'  => 'Boxing Day',
            ],
        ];
    }
}
