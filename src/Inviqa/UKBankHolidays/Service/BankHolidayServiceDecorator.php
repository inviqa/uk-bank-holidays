<?php

namespace Inviqa\UKBankHolidays\Service;

use DateTime;
use DateTimeInterface;
use Inviqa\UKBankHolidays\Exception\InvalidDateRangeException;
use Inviqa\UKBankHolidays\Region;

class BankHolidayServiceDecorator
{
    private const DATETIME_FORMAT = 'Y-m-d';

    private $bankHolidayService;

    public function __construct(BankHolidayService $bankHolidayService)
    {
        $this->bankHolidayService = $bankHolidayService;
    }

    public function check(DateTimeInterface $dateTime, Region $region): bool
    {
        $bankHolidays = $this->bankHolidayService->getBankHolidays();

        $key = $region->getRegion() . '_' . $dateTime->format(self::DATETIME_FORMAT);

        return array_key_exists($key, $bankHolidays);
    }


    public function getAll(?DateTimeInterface $from = null, ?DateTimeInterface $to = null, ?Region $region = null): array
    {
        $bankHolidays = $this->bankHolidayService->getBankHolidays();
        $dates = [];

        $fromTimestamp = ($from instanceof DateTimeInterface) ? $from->getTimestamp() : null;
        $toTimestamp = ($to instanceof DateTimeInterface) ? $to->getTimestamp() : null;

        if ($from !== null && $to !== null && $fromTimestamp >= $toTimestamp) {
            throw InvalidDateRangeException::withDates($from, $to);
        }

        foreach ($bankHolidays as $bankHoliday) {
            if ($region !== null && $bankHoliday['region'] !== $region->getRegion()) {
                continue;
            }

            $bankHolidayTimestamp = DateTime::createFromFormat(self::DATETIME_FORMAT, $bankHoliday['date'])->getTimestamp();

            if (($fromTimestamp === null || $bankHolidayTimestamp >= $fromTimestamp) && ($toTimestamp === null || $bankHolidayTimestamp <= $toTimestamp)) {
                $dates[] = $bankHoliday;
            }
        }

        return $dates;
    }
}
