<?php

namespace Inviqa\UKBankHolidays;

use DateTimeInterface;
use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Region\Region;
use Inviqa\UKBankHolidays\Service\BankHolidayService;
use Inviqa\UKBankHolidays\Service\BankHolidayServiceFactory;

class Application
{
    private const CACHE_KEY_PREFFIX_CHECK = 'check_';
    private const CACHE_KEY_PREFFIX_LIST = 'all_';

    private $bankHolidayService;
    private $cache;

    public function __construct(Configuration $configuration, CacheProvider $cacheProvider)
    {
        $this->bankHolidayService = BankHolidayServiceFactory::buildFrom($configuration);
        $this->cache = $cacheProvider;
    }

    public function check(DateTimeInterface $dateTime): bool
    {
        $cacheKey = self::CACHE_KEY_PREFFIX_CHECK . $dateTime->getTimestamp();

        if ($this->cache->has($cacheKey)) {
            $value = $this->cache->get($cacheKey);
        } else {
            $value = $this->bankHolidayService->check($dateTime);
            $this->cache->set($cacheKey, $value);
        }

        return $value;
    }

    public function getAll(
        ?DateTimeInterface $from = null,
        ?DateTimeInterface $to = null,
        ?Region $region = null
    ): array {

        $cacheKey = self::CACHE_KEY_PREFFIX_LIST;

        if ($from !== null) {
            $cacheKey .= $from->getTimestamp();
        } else {
            $cacheKey .= '#_';
        }

        if ($to !== null) {
            $cacheKey .= $to->getTimestamp();
        } else {
            $cacheKey .= '#_';
        }

        if ($region !== null) {
            $cacheKey .= $region->getRegion();
        } else {
            $cacheKey .= '#';
        }


        if ($this->cache->has($cacheKey)) {
            $value = $this->cache->get($cacheKey);
        } else {
            $value = $this->bankHolidayService->getAll($from, $to, $region);
            $this->cache->set($cacheKey, $value);
        }

        return $value;
    }

    public function getService(): BankHolidayService
    {
        return $this->bankHolidayService;
    }
}
