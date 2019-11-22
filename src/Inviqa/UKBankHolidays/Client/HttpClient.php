<?php

namespace Inviqa\UKBankHolidays\Client;

class HttpClient implements Client
{
    public const SERVICE_URL = 'https://www.gov.uk/bank-holidays.json';

    private $client;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function getBankHolidays(): string
    {
        $response = $this->client->get(self::SERVICE_URL);

        return $response->getBody()->getContents();
    }
}
