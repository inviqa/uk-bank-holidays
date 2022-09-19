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
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY);
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

    function it_describes_a_bank_holiday_date
    (
        CacheProvider $cacheProvider,
        Configuration $configuration
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY);
        $extraConfig = [
            'response_body' => [
                'well-formed' => TestResponseBodyFactory::buildWellFormedResponseJson(),
                'malformed'   => null,
            ],
        ];

        $configuration->getExtraConfig()->willReturn($extraConfig);
        $cacheProvider->has(Argument::type('string'))->willReturn(false);
        $cacheProvider->set(Argument::type('string'), Argument::any())->shouldBeCalled();

        $info = $this->describe($date, 'england-and-wales');
        $info->offsetGet('title')->shouldBe(TestBankHolidaysData::BANK_HOLIDAY_TITLE);
        $info->offsetGet('date')->shouldBe(TestBankHolidaysData::BANK_HOLIDAY);
        $info->offsetGet('region')->shouldBe('england-and-wales');
    }

    function it_returns_false_for_a_non_bank_holiday_date
    (
        CacheProvider $cacheProvider,
        Configuration $configuration
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY);
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

    function it_does_not_describe_a_non_bank_holiday_date
    (
        CacheProvider $cacheProvider,
        Configuration $configuration
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY);
        $extraConfig = [
            'response_body' => [
                'well-formed' => TestResponseBodyFactory::buildWellFormedResponseJson(),
                'malformed'   => null,
            ],
        ];

        $configuration->getExtraConfig()->willReturn($extraConfig);
        $cacheProvider->has(Argument::type('string'))->willReturn(false);
        $cacheProvider->set(Argument::type('string'), Argument::any())->shouldBeCalled();

        $this->describe($date, 'england-and-wales')->shouldBe(null);
    }

    function it_returns_an_array_for_a_date_range
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

    function it_returns_an_array_for_a_date_range_with_a_region
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

        $this->getAll($from, $to, 'england-and-wales')->shouldBe(TestBankHolidaysData::getExpectedResultForDateRangeWithRegion());
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
