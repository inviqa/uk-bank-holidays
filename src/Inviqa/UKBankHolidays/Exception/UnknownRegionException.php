<?php

namespace Inviqa\UKBankHolidays\Exception;

use Inviqa\UKBankHolidays\Region\Region;

class UnknownRegionException extends UKBankHolidaysException
{
    public const UNKNOW_REGION_MESSAGE = 'Unknow Region: "%s"';

    public static function withRegion(Region $region): UnknownRegionException
    {
        $exception = new static(sprintf(self::UNKNOW_REGION_MESSAGE, $region->getRegion()));

        return $exception;
    }
}
