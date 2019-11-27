<?php

namespace TestService;

use Inviqa\UKBankHolidays\Configuration;

class TestConfiguration implements Configuration
{
    private $extraConfig = [
        'response_body' => [
            'well-formed' => null,
            'malformed'   => null,
        ],
        'behat_config'  => [
            'response_body' => null,
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
        $this->extraConfig['behat_config']['response_body'] = TestResponseBodyFactory::buildSingleBehatFeatureJson($region, $date);
    }

    public function addWellFormedResponseBody()
    {
        $this->extraConfig['response_body']['well-formed'] = TestResponseBodyFactory::buildWellFormedResponseJson();
    }

    public function addMalformedResponseBody()
    {
        $this->extraConfig['response_body']['malformed'] = TestResponseBodyFactory::buildMalformedResponseJson();
    }
}
