<?php

namespace Inviqa\UKBankHolidays\Service;

use Exception;
use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Client\Client;
use Inviqa\UKBankHolidays\Exception\UKBankHolidaysException;
use Inviqa\UKBankHolidays\ResponseParser;
use Inviqa\UKBankHolidays\Result;

class BankHolidayService
{
    public const CACHE_KEY = 'bank_holiday_raw_data';
    public const CACHE_KEY_BY_DATE = 'by_date';
    public const CACHE_KEY_BY_REGION = 'by_region';

    private $apiClient;
    private $responseParser;
    private $cache;

    public function __construct(
        Client $apiClient,
        ResponseParser $responseParser,
        CacheProvider $cacheProvider
    ) {
        $this->apiClient = $apiClient;
        $this->responseParser = $responseParser;
        $this->cache = $cacheProvider;
    }

    public function getBankHolidays(): Result
    {
        try {
            if (!$this->cache->has(self::CACHE_KEY)) {
                $responseBody = $this->apiClient->getBankHolidays();
                $result = $this->responseParser->extractResultFrom($responseBody);

                $formattedData = $this->formatRawData($result);

                $this->cache->set(self::CACHE_KEY, $formattedData);
            }

            return $this->cache->get(self::CACHE_KEY);

        } catch (Exception $e) {
            throw new UKBankHolidaysException($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function formatRawData(Result $result)
    {
        $data = [];
        $data[self::CACHE_KEY_BY_DATE] = $this->formatDataByDate($result);
        $data[self::CACHE_KEY_BY_REGION] = $this->formatDataByRegion($result);

        return $data;
    }

    private function formatDataByDate(Result $result): array
    {
        $data = [];

        foreach ($result->getContent() as $division) {
            foreach ($division['events'] as $event) {
                $data[$event['date']] = [
                    'date'  => $event['date'],
                    'title' => $event['title'],
                ];
            }
        }

        return $data;
    }

    private function formatDataByRegion(Result $result): array
    {
        $data = [];

        foreach ($result->getContent() as $division) {
            $region = $division['division'];

            foreach ($division['events'] as $event) {
                $data[$region][$event['date']] = [
                    'date'  => $event['date'],
                    'title' => $event['title'],
                ];
            }
        }

        return $data;
    }
}
