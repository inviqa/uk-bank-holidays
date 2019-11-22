<?php

namespace Inviqa\UKBankHolidays\Region;

class Scotland implements Region
{
    private const REGION_CODE = 'scotland';

    public function getRegion(): string
    {
        return self::REGION_CODE;
    }
}