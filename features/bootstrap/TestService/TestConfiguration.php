<?php

namespace TestService;

use Inviqa\UKBankHolidays\Configuration;

class TestConfiguration implements Configuration
{
    private $extraConfig = [
        'response_body' => [
            // 'well-formed' => null,
            // 'malformed'   => null,
        ],
    ];

    public function isTestMode(): bool
    {
        return true;
    }

    public function getExtraConfig(): array
    {
        return $this->extraConfig;
    }

    public function addBankHolidayResult(string $region, string $date)
    {
        $this->extraConfig['response_body'][$region] = [
            'division' => $region,
            'events'   => [
                [
                    'title'   => 'Sample Holiday',
                    'date'    => $date,
                    'notes'   => '',
                    'bunting' => true,
                ],
            ],
        ];
    }

    public function addSuccessEvent()
    {
        $this->extraConfig['response_body']['well-formed'] = TestResponseBodyFactory::buildWellFormedResponseJson();
    }

    public function addFailureEvent()
    {
        $this->extraConfig['response_body']['malformed'] = TestResponseBodyFactory::buildMalformedResponseJson();
    }
}
