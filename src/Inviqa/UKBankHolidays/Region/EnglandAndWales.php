<?php

namespace Inviqa\UKBankHolidays\Region;

class EnglandAndWales implements Region
{
    private const REGION_CODE = 'england-and-wales';

    public function getRegion(): string
    {
        return self::REGION_CODE;
    }
}