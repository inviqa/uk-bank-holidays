<?php

namespace spec\Inviqa\UKBankHolidays\Service;

use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Configuration;
use Inviqa\UKBankHolidays\Service\BankHolidayService;
use Inviqa\UKBankHolidays\Service\BankHolidayServiceFactory;
use PhpSpec\ObjectBehavior;

class BankHolidayServiceFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BankHolidayServiceFactory::class);
    }

    function it_builds_and_returns_the_bank_holiday_service(
        Configuration $configuration,
        CacheProvider $cacheProvider
    ) {
        $configuration->isTestMode()->willReturn(false);

        $this::buildFrom($configuration, $cacheProvider)->shouldBeAnInstanceOf(BankHolidayService::class);
    }
}
