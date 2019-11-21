<?php

namespace Inviqa\UKBankHolidays\Client;

use GuzzleHttp\Client;

class HttpApiClient implements ApiClient
{
    public const ENDPOINT = 'bank-holidays.json';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getBankHolidays(): string
    {
        $response = $this->client->get(self::ENDPOINT);

        return $response->getBody()->getContents();
    }
}
