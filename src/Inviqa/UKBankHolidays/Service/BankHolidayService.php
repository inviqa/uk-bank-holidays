<?php

namespace Inviqa\UKBankHolidays\Service;

use Exception;
use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Client\Client;
use Inviqa\UKBankHolidays\Exception\UKBankHolidaysException;
use Inviqa\UKBankHolidays\ResponseParser;

class BankHolidayService
{
    public const CACHE_KEY = 'uk_bank_holidays';

    private $client;
    private $responseParser;
    private $cache;

    public function __construct(
        Client $client,
        ResponseParser $responseParser,
        CacheProvider $cacheProvider
    ) {
        $this->client = $client;
        $this->responseParser = $responseParser;
        $this->cache = $cacheProvider;
    }

    public function getBankHolidays(): array
    {
        try {
            if (!$this->cache->has(self::CACHE_KEY)) {
                $responseBody = $this->client->getBankHolidays();
                $response = $this->responseParser->decodeResponse($responseBody);
                $content = $this->formatData($response);
                $this->cache->set(self::CACHE_KEY, $content);

                return $content;
            } else {
                return $this->cache->get(self::CACHE_KEY);
            }

        } catch (Exception $e) {
            throw new UKBankHolidaysException($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function formatData(array $content = []): array
    {
        $data = [];

        foreach ($content as $division) {
            $region = $division['division'];

            foreach ($division['events'] as $event) {
                $data[$region . '_' . $event['date']] = [
                    'region' => $region,
                    'date'   => $event['date'],
                    'title'  => $event['title'],
                ];
            }
        }

        return $data;
    }
}
