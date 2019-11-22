<?php

namespace Inviqa\UKBankHolidays\Region;

class NorthernIreland implements Region
{
    private const REGION_CODE = 'northern-ireland';

    public function getRegion(): string
    {
        return self::REGION_CODE;
    }
}