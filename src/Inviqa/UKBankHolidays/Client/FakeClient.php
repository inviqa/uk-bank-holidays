<?php

namespace Inviqa\UKBankHolidays\Client;

use Inviqa\UKBankHolidays\Configuration;
use Inviqa\UKBankHolidays\Exception\UKBankHolidaysException;
use RuntimeException;

class FakeClient implements Client
{
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getBankHolidays(): string
    {
        $extraConfig = $this->configuration->getExtraConfig();

        // $response = null;

        return json_encode($extraConfig['response_body']);

        // if ($extraConfig['response_body']['well-formed'] !== null) {
        //     $response = $extraConfig['response_body']['well-formed'];
        // }
        //
        // if ($extraConfig['response_body']['malformed'] !== null) {
        //     $response = $extraConfig['response_body']['malformed'];
        // }
        //
        // return $response;
    }
}
