<?php

namespace Inviqa\UKBankHolidays\Service;

use DateTimeInterface;
use Exception;
use Inviqa\UKBankHolidays\Exception\UKBankHolidaysException;
use Inviqa\UKBankHolidays\Region\Region;
use Inviqa\UKBankHolidays\Result;

class BankHolidayServiceDecorator
{
    private $bankHolidayService;

    public function __construct(BankHolidayService $bankHolidayService)
    {
        $this->bankHolidayService = $bankHolidayService;
    }

    public function check(DateTimeInterface $dateTime, ?Region $region = null): bool
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
