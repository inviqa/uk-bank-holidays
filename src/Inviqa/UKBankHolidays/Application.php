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
    private $bankHolidayDecorator;
    private $bankHolidayService;

    public function __construct(Configuration $configuration, CacheProvider $cacheProvider)
    {
        $this->bankHolidayService = BankHolidayServiceFactory::buildFrom($configuration, $cacheProvider);
        $this->bankHolidayDecorator = new BankHolidayServiceDecorator($this->bankHolidayService);
    }

    public function check(DateTimeInterface $dateTime, ?Region $region = null): bool
    {
        return $result = $this->bankHolidayDecorator->check($dateTime, $region);
    }

    public function getAll(
        ?DateTimeInterface $from = null,
        ?DateTimeInterface $to = null,
        ?Region $region = null
    ): array {
        return $result = $this->bankHolidayDecorator->getAll($from, $to, $region);
    }

    public function getService(): BankHolidayService
    {
        return $this->bankHolidayService;
    }
}
