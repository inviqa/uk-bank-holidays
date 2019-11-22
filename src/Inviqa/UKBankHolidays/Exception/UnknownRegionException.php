<?php

namespace Inviqa\UKBankHolidays\Exception;

class UnknownRegionException extends UKBankHolidaysException
{
    public const UNKNOW_REGION_MESSAGE = 'Unknow Region: "%s"';

    public static function withRegion(string $region): UnknownRegionException
    {
        $exception = new static(sprintf(self::UNKNOW_REGION_MESSAGE, $region));

        return $exception;
    }
}
