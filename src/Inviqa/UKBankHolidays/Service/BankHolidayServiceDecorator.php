<?php

namespace Inviqa\UKBankHolidays\Service;

use DateTime;
use DateTimeInterface;
use Inviqa\UKBankHolidays\Exception\InvalidDateRangeException;
use Inviqa\UKBankHolidays\Exception\UnknownRegionException;
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
        $bankHolidays = $this->getDates($region);
        $dateToCheck = $dateTime->format(self::DATETIME_FORMAT);

        return array_key_exists($dateToCheck, $bankHolidays);
    }


    public function getAll(?DateTimeInterface $from = null, ?DateTimeInterface $to = null, ?Region $region = null): array
    {
        $bankHolidays = $this->getDates($region);
        $dates = [];

        $fromTimestamp = ($from instanceof DateTimeInterface) ? $from->getTimestamp() : null;
        $toTimestamp = ($to instanceof DateTimeInterface) ? $to->getTimestamp() : null;

        if ($from !== null && $to !== null && $fromTimestamp >= $toTimestamp) {
            throw InvalidDateRangeException::withDates($from, $to);
        }

        foreach ($bankHolidays as $bankHoliday) {
            $bankHolidayTimestamp = DateTime::createFromFormat(self::DATETIME_FORMAT, $bankHoliday['date'])->getTimestamp();

            if (($fromTimestamp === null || $bankHolidayTimestamp >= $fromTimestamp) && ($toTimestamp === null || $bankHolidayTimestamp <= $toTimestamp)) {
                $dates[$bankHoliday['date']] = $bankHoliday['date'];
            }
        }

        return $dates;
    }

    private function getDates(?Region $region = null): array
    {
        if ($region === null) {
            $dates = $this->bankHolidayService->getBankHolidaysSortedByDate();
        } else {
            $dates = $this->bankHolidayService->getBankHolidaysSortedByRegion();

            if (array_key_exists($region->getRegion(), $dates)) {
                $dates = $dates[$region->getRegion()];
            } else {
                throw UnknownRegionException::withRegion($region->getRegion());
            }
        }

        return $dates;
    }
}
