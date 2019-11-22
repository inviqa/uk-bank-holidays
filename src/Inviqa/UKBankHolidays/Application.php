<?php

namespace Inviqa\UKBankHolidays;

use DateTimeInterface;
use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Region\Region;
use Inviqa\UKBankHolidays\Service\BankHolidayService;
use Inviqa\UKBankHolidays\Service\BankHolidayServiceFactory;

class Application
{
    private $bankHolidayService;
    private $cacheProvider;

    public function __construct(Configuration $configuration, CacheProvider $cacheProvider)
    {
        $this->bankHolidayService = BankHolidayServiceFactory::buildFrom($configuration);
        $this->cacheProvider = $cacheProvider;
    }

    public function check(DateTimeInterface $dateTime): bool
    {
        return $this->bankHolidayService->check($dateTime);
    }

    public function getAll(
        ?DateTimeInterface $from = null,
        ?DateTimeInterface $to = null,
        ?Region $region = null
    ): array {
        return $this->bankHolidayService->getAll($from, $to, $region);
    }

    public function getService(): BankHolidayService
    {
        return $this->bankHolidayService;
    }
}
