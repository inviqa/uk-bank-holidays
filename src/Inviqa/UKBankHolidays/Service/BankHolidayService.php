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
    public const CACHE_KEY_BY_DATE = 'bank_holiday_by_date';
    public const CACHE_KEY_BY_REGION = 'bank_holiday_by_region';
    public const CACHE_KEY_RAW_DATA = 'bank_holida_raw_data';

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
            if (!$this->cache->has(self::CACHE_KEY_RAW_DATA)) {
                $responseBody = $this->apiClient->getBankHolidays();
                $result = $this->responseParser->extractResultFrom($responseBody);

                $this->cache->set(self::CACHE_KEY_RAW_DATA, $result);
            }

            return $this->cache->get(self::CACHE_KEY_RAW_DATA);

        } catch (Exception $e) {
            throw new UKBankHolidaysException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getBankHolidaysSortedByDate(): array
    {
        if (!$this->cache->has(self::CACHE_KEY_BY_DATE)) {
            $result = $this->getBankHolidays();
            $this->cache->set(self::CACHE_KEY_BY_DATE, $this->formatDataByDate($result));
        }

        return $this->cache->get(self::CACHE_KEY_BY_DATE);
    }

    public function getBankHolidaysSortedByRegion(): array
    {
        if (!$this->cache->has(self::CACHE_KEY_BY_REGION)) {
            $result = $this->getBankHolidays();
            $this->cache->set(self::CACHE_KEY_BY_REGION, $this->formatDataByRegion($result));
        }

        return $this->cache->get(self::CACHE_KEY_BY_REGION);
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
