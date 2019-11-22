<?php

namespace Inviqa\UKBankHolidays\Region;

use Inviqa\UKBankHolidays\Exception\UnknownRegionException;

final class Region
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

    public function isAvailableRegion(string $region): bool
    {
        return in_array($string, $this->regions);
    }

    public function getRegion()
    {
        return $this->region;
    }
}