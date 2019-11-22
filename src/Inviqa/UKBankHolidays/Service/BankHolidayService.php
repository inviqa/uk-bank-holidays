<?php

namespace Inviqa\UKBankHolidays\Service;

use DateTimeInterface;
use Exception;
use Inviqa\UKBankHolidays\Client\Client;
use Inviqa\UKBankHolidays\Exception\UKBankHolidaysException;
use Inviqa\UKBankHolidays\Region\Region;
use Inviqa\UKBankHolidays\ResponseParser;
use Inviqa\UKBankHolidays\Result;

class BankHolidayService
{
    private $apiClient;
    private $responseParser;

    public function __construct(
        Client $apiClient,
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

    public function getAll(
        ?DateTimeInterface $from = null,
        ?DateTimeInterface $to = null,
        ?Region $region = null
    ): array {
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
