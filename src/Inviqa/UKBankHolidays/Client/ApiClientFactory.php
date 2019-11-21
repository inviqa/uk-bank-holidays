<?php

namespace Inviqa\UKBankHolidays\Client;

use GuzzleHttp\Client;
use Inviqa\UKBankHolidays\Configuration;

class ApiClientFactory
{
    public static function buildFrom(Configuration $configuration): ApiClient
    {
        if ($configuration->isTestMode()) {
            return new FakeApiClient($configuration);
        }

        $guzzleClient = new Client([
            'base_url'   => $configuration->getDomain(),
        ]);

        return new HttpApiClient($guzzleClient);
    }
}
