<?php

namespace Inviqa\UKBankHolidays;

use Inviqa\UKBankHolidays\Exception\UnknownRegionException;

class Region
{
    private const REGION_ENGLAND_WALES = 'england-and-wales';
    private const REGION_NORTHERN_IRELAND = 'northern-ireland';
    private const REGION_SCOTLAND = 'scotland';

    private $regions = [
        self::REGION_ENGLAND_WALES,
        self::REGION_NORTHERN_IRELAND,
        self::REGION_SCOTLAND,
    ];

    private $region;

    private function __construct()
    {
    }

    public static function createFromString(string $region): Region
    {
        $regionObj = new self();

        if (!$regionObj->isAvailableRegion($region)) {
            throw UnknownRegionException::withRegion($region);
        }

        $regionObj->region = $region;

        return $regionObj;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    private function isAvailableRegion(string $region): bool
    {
        return in_array($region, $this->regions);
    }
}