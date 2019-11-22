<?php

namespace Inviqa\UKBankHolidays\Exception;

use DateTimeInterface;

class InvalidDateRangeException extends UKBankHolidaysException
{
    public const INVALID_DATE_RANGE_MESSAGE = 'The provided date range is invalid. "To" ("%s") must be a later date then "From" ("%s")';

    public static function withDates(DateTimeInterface $from, DateTimeInterface $to): InvalidDateRangeException
    {
        $exception = new static(sprintf(self::INVALID_DATE_RANGE_MESSAGE, $to->format('Y-m-d'), $from->format('Y-m-d')));

        return $exception;
    }
}
