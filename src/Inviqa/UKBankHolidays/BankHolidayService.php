<?php

namespace Inviqa\UKBankHolidays;

use DateTimeInterface;
use Exception;
use Inviqa\UKBankHolidays\Client\ApiClient;
use Inviqa\UKBankHolidays\Exception\UKBankHolidaysException;

class BankHolidayService
{
    private $apiClient;
    private $responseParser;

    public function __construct(
        ApiClient $apiClient,
        ResponseParser $responseParser
    ) {
        $this->apiClient = $apiClient;
        $this->responseParser = $responseParser;
    }

    public function check(DateTimeInterface $dateTime): bool
    {
        $result = $this->getBankHolidays();
        return true;
    }

    public function getAll(?DateTimeInterface $from = null, ?DateTimeInterface $to = null, ?string $region = null): array
    {
        $result = $this->getBankHolidays();
        return [];
    }


    private function getBankHolidays(): Result
    {
        try {
            $responseBody = $this->apiClient->getBankHolidays();
            return $this->responseParser->extractResultFrom($responseBody);
        } catch (Exception $e) {
            throw new UKBankHolidaysException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
