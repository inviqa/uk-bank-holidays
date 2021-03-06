<?php

namespace Inviqa\UKBankHolidays\Client;

use Inviqa\UKBankHolidays\Configuration;

class ClientFactory
{
    public static function buildFrom(Configuration $configuration): Client
    {
        if ($configuration->isTestMode()) {
            return new FakeClient($configuration);
        }

        $client = new \GuzzleHttp\Client();

        return new HttpClient($client);
    }
}
