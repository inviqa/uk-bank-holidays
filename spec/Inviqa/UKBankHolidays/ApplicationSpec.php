<?php

namespace spec\Inviqa\UKBankHolidays;

use DateTime;
use Inviqa\UKBankHolidays\Application;
use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Configuration;
use Inviqa\UKBankHolidays\Service\BankHolidayService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TestService\TestBankHolidaysData;
use TestService\TestResponseBodyFactory;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Application::class);
    }

    function let(Configuration $configuration, CacheProvider $cacheProvider)
    {
        $configuration->isTestMode()->willReturn(true);
        $this->beConstructedWith($configuration, $cacheProvider);
    }

    function it_returns_the_bank_holiday_service()
    {
        $this->getService()->shouldBeAnInstanceOf(BankHolidayService::class);
    }

    function it_returns_true_for_a_bank_holiday_date
    (
        CacheProvider $cacheProvider,
        Configuration $configuration
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::REGIONAL_BANK_HOLIDAY);
        $extraConfig = [
            'response_body' => [
                'well-formed' => TestResponseBodyFactory::buildWellFormedResponseJson(),
                'malformed'   => null,
            ],
        ];

        $configuration->getExtraConfig()->willReturn($extraConfig);
        $cacheProvider->has(Argument::type('string'))->willReturn(false);
        $cacheProvider->set(Argument::type('string'), Argument::any())->shouldBeCalled();

        $this->check($date, 'england-and-wales')->shouldBe(true);
    }

    function it_returns_false_for_a_non_bank_holiday_date
    (
        CacheProvider $cacheProvider,
        Configuration $configuration
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::REGIONAL_BANK_HOLIDAY);
        $extraConfig = [
            'response_body' => [
                'well-formed' => TestResponseBodyFactory::buildWellFormedResponseJson(),
                'malformed'   => null,
            ],
        ];

        $configuration->getExtraConfig()->willReturn($extraConfig);
        $cacheProvider->has(Argument::type('string'))->willReturn(false);
        $cacheProvider->set(Argument::type('string'), Argument::any())->shouldBeCalled();

        $this->check($date, 'scotland')->shouldBe(false);
    }

    function it_returns_an_array_with_three_items_for_a_date_range
    (
        CacheProvider $cacheProvider,
        Configuration $configuration
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_TO);
        $extraConfig = [
            'response_body' => [
                'well-formed' => TestResponseBodyFactory::buildWellFormedResponseJson(),
                'malformed'   => null,
            ],
        ];

        $configuration->getExtraConfig()->willReturn($extraConfig);
        $cacheProvider->has(Argument::type('string'))->willReturn(false);
        $cacheProvider->set(Argument::type('string'), Argument::any())->shouldBeCalled();

        $this->getAll($from, $to)->shouldBe(TestBankHolidaysData::getExpectedResultForDateRange());
    }

    function it_returns_an_array_with_three_items_for_a_date_range_with_a_region_with_additional_bank_holidays
    (
        CacheProvider $cacheProvider,
        Configuration $configuration
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_TO);
        $extraConfig = [
            'response_body' => [
                'well-formed' => TestResponseBodyFactory::buildWellFormedResponseJson(),
                'malformed'   => null,
            ],
        ];

        $configuration->getExtraConfig()->willReturn($extraConfig);
        $cacheProvider->has(Argument::type('string'))->willReturn(false);
        $cacheProvider->set(Argument::type('string'), Argument::any())->shouldBeCalled();

        $this->getAll($from, $to, 'england-and-wales')->shouldBe(TestBankHolidaysData::getExpectedResultForDateRange());
    }

    function it_returns_an_empty_array_for_a_date_range_with_no_bank_holidays
    (
        CacheProvider $cacheProvider,
        Configuration $configuration
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY_RANGE_TO);
        $extraConfig = [
            'response_body' => [
                'well-formed' => TestResponseBodyFactory::buildWellFormedResponseJson(),
                'malformed'   => null,
            ],
        ];

        $configuration->getExtraConfig()->willReturn($extraConfig);
        $cacheProvider->has(Argument::type('string'))->willReturn(false);
        $cacheProvider->set(Argument::type('string'), Argument::any())->shouldBeCalled();

        $this->getAll($from, $to)->shouldBe([]);
    }
}
