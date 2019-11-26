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
    ];

    public function isTestMode(): bool
    {
        return true;
    }

    public function getExtraConfig(): array
    {
        return $this->extraConfig;
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
