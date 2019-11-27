<?php

namespace Inviqa\UKBankHolidays\Client;

use Inviqa\UKBankHolidays\Configuration;

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

        $response = null;

        if ($extraConfig['response_body']['well-formed'] !== null) {
            $response = $extraConfig['response_body']['well-formed'];
        } elseif ($extraConfig['response_body']['malformed'] !== null) {
            $response = $extraConfig['response_body']['malformed'];
        } elseif ($extraConfig['behat_config']['response_body'] !== null) {
            $response = $extraConfig['behat_config']['response_body'];
        }

        return $response;
    }
}
