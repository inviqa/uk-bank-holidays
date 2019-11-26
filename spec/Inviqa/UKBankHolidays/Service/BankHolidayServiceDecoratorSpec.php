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
        $datesSortedByDate = TestBankHolidaysData::getBankHolidaysSortedByDate();

        $bankHolidayService->getBankHolidaysSortedByDate()->willReturn($datesSortedByDate);

        $this->check($date)->shouldBe(true);
    }

    function it_returns_true_for_a_regional_bank_holiday_date
    (
        BankHolidayService $bankHolidayService
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::REGIONAL_BANK_HOLIDAY);
        $datesSortedByRegion = TestBankHolidaysData::getBankHolidaysSortedByRegion();
        $region = Region::createFromString('england-and-wales');

        $bankHolidayService->getBankHolidaysSortedByRegion()->willReturn($datesSortedByRegion);

        $this->check($date, $region)->shouldBe(true);
    }

    function it_returns_false_for_a_non_bank_holiday_date
    (
        BankHolidayService $bankHolidayService
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY);
        $datesSortedByDate = TestBankHolidaysData::getBankHolidaysSortedByDate();

        $bankHolidayService->getBankHolidaysSortedByDate()->willReturn($datesSortedByDate);

        $this->check($date)->shouldBe(false);
    }

    function it_returns_false_for_a_non_bank_holiday_date_in_a_specific_region
    (
        BankHolidayService $bankHolidayService
    ) {
        $date = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::REGIONAL_BANK_HOLIDAY);
        $datesSortedByRegion = TestBankHolidaysData::getBankHolidaysSortedByRegion();
        $region = Region::createFromString('scotland');

        $bankHolidayService->getBankHolidaysSortedByRegion()->willReturn($datesSortedByRegion);

        $this->check($date, $region)->shouldBe(false);
    }

    function it_returns_an_array_with_three_items_for_a_date_range
    (
        BankHolidayService $bankHolidayService
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_TO);
        $datesSortedByDate = TestBankHolidaysData::getBankHolidaysSortedByDate();

        $bankHolidayService->getBankHolidaysSortedByDate()->willReturn($datesSortedByDate);

        $this->getAll($from, $to)->shouldBe(TestBankHolidaysData::getExpectedResultForDateRange());
    }

    function it_returns_an_array_with_three_items_for_a_date_range_with_a_region_with_additional_bank_holidays
    (
        BankHolidayService $bankHolidayService
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::BANK_HOLIDAY_RANGE_TO);
        $datesSortedByRegion = TestBankHolidaysData::getBankHolidaysSortedByRegion();
        $region = Region::createFromString('england-and-wales');

        $bankHolidayService->getBankHolidaysSortedByRegion()->willReturn($datesSortedByRegion);

        $this->getAll($from, $to, $region)->shouldBe(TestBankHolidaysData::getExpectedResultForDateRange());
    }

    function it_returns_an_empty_array_for_a_date_range_with_no_bank_holidays
    (
        BankHolidayService $bankHolidayService
    ) {
        $from = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY_RANGE_FROM);
        $to = DateTime::createFromFormat(TestBankHolidaysData::DATETIME_FORMAT, TestBankHolidaysData::NON_BANK_HOLIDAY_RANGE_TO);
        $datesSortedByDate = TestBankHolidaysData::getBankHolidaysSortedByDate();

        $bankHolidayService->getBankHolidaysSortedByDate()->willReturn($datesSortedByDate);

        $this->getAll($from, $to)->shouldBe([]);
    }
}
