<?php

namespace spec\Inviqa\UKBankHolidays\Service;

use DateTime;
use Inviqa\UKBankHolidays\Region;
use Inviqa\UKBankHolidays\Service\BankHolidayService;
use Inviqa\UKBankHolidays\Service\BankHolidayServiceDecorator;
use PhpSpec\ObjectBehavior;
use TestService\TestBankHolidaysData;

class BankHolidayServiceDecoratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BankHolidayServiceDecorator::class);
    }

    function let
    (
        BankHolidayService $bankHolidayService
    ) {
        $this->beConstructedWith($bankHolidayService);
    }

    function it_returns_true_for_a_bank_holiday_date
    (
        BankHolidayService $bankHolidayService
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY);
        $dates = TestBankHolidaysData::getBankHolidays();
        $region = Region::createFromString('england-and-wales');

        $bankHolidayService->getBankHolidays()->willReturn($dates);

        $this->check($date, $region)->shouldBe(true);
    }

    function it_returns_false_for_a_non_bank_holiday_date
    (
        BankHolidayService $bankHolidayService
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY);
        $dates = TestBankHolidaysData::getBankHolidays();
        $region = Region::createFromString('scotland');

        $bankHolidayService->getBankHolidays()->willReturn($dates);

        $this->check($date, $region)->shouldBe(false);
    }

    function it_returns_an_array_for_a_date_range
    (
        BankHolidayService $bankHolidayService
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_TO);
        $dates = TestBankHolidaysData::getBankHolidays();

        $bankHolidayService->getBankHolidays()->willReturn($dates);

        $this->getAll($from, $to)->shouldBe(TestBankHolidaysData::getExpectedResultForDateRange());
    }

    function it_returns_an_array_for_a_date_range_with_a_region
    (
        BankHolidayService $bankHolidayService
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_TO);
        $dates = TestBankHolidaysData::getBankHolidays();
        $region = Region::createFromString('england-and-wales');

        $bankHolidayService->getBankHolidays()->willReturn($dates);

        $this->getAll($from, $to, $region)->shouldBe(TestBankHolidaysData::getExpectedResultForDateRangeWithRegion());
    }

    function it_returns_an_empty_array_for_a_date_range_with_no_bank_holidays
    (
        BankHolidayService $bankHolidayService
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY_RANGE_TO);
        $dates = TestBankHolidaysData::getBankHolidays();

        $bankHolidayService->getBankHolidays()->willReturn($dates);

        $this->getAll($from, $to)->shouldBe([]);
    }
}
