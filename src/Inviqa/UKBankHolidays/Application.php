<?php

namespace Inviqa\UKBankHolidays;

use DateTimeInterface;
use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Region\Region;
use Inviqa\UKBankHolidays\Service\BankHolidayService;
use Inviqa\UKBankHolidays\Service\BankHolidayServiceDecorator;
use Inviqa\UKBankHolidays\Service\BankHolidayServiceFactory;

class Application
{
    private const CACHE_KEY_PREFFIX_CHECK = 'check_';
    private const CACHE_KEY_PREFFIX_LIST = 'all_';
    private const CACHE_KEY_PLACEHOLDER = '#_';

    private $bankHolidayDecorator;
    private $bankHolidayService;
    private $cache;

    public function __construct(Configuration $configuration, CacheProvider $cacheProvider)
    {
        $this->bankHolidayService = BankHolidayServiceFactory::buildFrom($configuration, $cacheProvider);
        $this->bankHolidayDecorator = new BankHolidayServiceDecorator($this->bankHolidayService);
        $this->cache = $cacheProvider;
    }

    public function check(DateTimeInterface $dateTime): bool
    {
        $cacheKey = self::CACHE_KEY_PREFFIX_CHECK . $dateTime->getTimestamp();

        if (!$this->cache->has($cacheKey)) {
            $result = $this->bankHolidayDecorator->check($dateTime);
            $this->cache->set($cacheKey, $result);
        }

        return $this->cache->get($cacheKey);
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
            $cacheKey .= self::CACHE_KEY_PLACEHOLDER;
        }

        if ($to !== null) {
            $cacheKey .= $to->getTimestamp();
        } else {
            $cacheKey .= self::CACHE_KEY_PLACEHOLDER;
        }

        if ($region !== null) {
            $cacheKey .= $region->getRegion();
        } else {
            $cacheKey .= self::CACHE_KEY_PLACEHOLDER;
        }

        if (!$this->cache->has($cacheKey)) {
            $result = $this->bankHolidayDecorator->getAll($from, $to, $region);
            $this->cache->set($cacheKey, $result);
        }

        return $this->cache->get($cacheKey);
    }

    public function getService(): BankHolidayService
    {
        return $this->bankHolidayService;
    }
}
