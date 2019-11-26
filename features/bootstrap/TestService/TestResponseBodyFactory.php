<?php

namespace TestService;

class TestResponseBodyFactory
{
    public static function buildWellFormedResponseJson()
    {
        $data = [
            'england-and-wales' =>
                [
                    'division' => 'england-and-wales',
                    'events'   => [
                        [
                            'title'   => 'Christmas Day',
                            'date'    => '2019-12-25',
                            'notes'   => '',
                            'bunting' => true,
                        ],
                        [
                            'title'   => 'Boxing Day',
                            'date'    => '2019-12-26',
                            'notes'   => '',
                            'bunting' => true,
                        ],
                        [
                            'title'   => 'New Year’s Day',
                            'date'    => '2020-01-01',
                            'notes'   => '',
                            'bunting' => true,
                        ],
                    ],
                ],
            'scotland'          => [
                'division' => 'scotland',
                'events'   => [
                    [
                        'title'   => 'Christmas Day',
                        'date'    => '2019-12-25',
                        'notes'   => '',
                        'bunting' => true,
                    ],
                    [
                        'title'   => 'Boxing Day',
                        'date'    => '2019-12-26',
                        'notes'   => '',
                        'bunting' => true,
                    ],
                    [
                        'title'   => 'New Year’s Day',
                        'date'    => '2020-01-01',
                        'notes'   => '',
                        'bunting' => true,
                    ],
                ],
            ],
        ];

        return json_encode($data);
    }

    public static function buildMalformedResponseJson()
    {
        return json_encode('I\'m not an array');
    }
}
