<?php

namespace spec\Inviqa\UKBankHolidays\Service;

use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Client\Client;
use Inviqa\UKBankHolidays\ResponseParser;
use Inviqa\UKBankHolidays\Service\BankHolidayService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TestService\TestBankHolidaysData;
use TestService\TestResponseBodyFactory;

class BankHolidayServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BankHolidayService::class);
    }

    function let(
        Client $client,
        ResponseParser $responseParser,
        CacheProvider $cacheProvider
    ) {
        $this->beConstructedWith($client, $responseParser, $cacheProvider);
    }

    function it_fetches_bank_holidays_and_returns_them_sorted_by_date(
        Client $client,
        ResponseParser $responseParser,
        CacheProvider $cacheProvider
    ) {
        $expectedReturnValue = TestBankHolidaysData::getBankHolidaysSortedByDate();

        $responseBody = TestResponseBodyFactory::buildWellFormedResponseJson();
        $decodedResponse = json_decode($responseBody, true);

        $client->getBankHolidays()->willReturn($responseBody);
        $responseParser->decodeResponse($responseBody)->willReturn($decodedResponse);

        $cacheProvider->has(BankHolidayService::CACHE_KEY_BY_DATE)->willReturn(false);
        $cacheProvider->has(BankHolidayService::CACHE_KEY_RAW_DATA)->willReturn(false);
        $cacheProvider->set(BankHolidayService::CACHE_KEY_BY_DATE, Argument::type('array'))->shouldBeCalled();
        $cacheProvider->set(BankHolidayService::CACHE_KEY_RAW_DATA, Argument::type('array'))->shouldBeCalled();

        $this->getBankHolidaysSortedByDate()->shouldBe($expectedReturnValue);
    }

    function it_fetches_bank_holidays_and_returns_them_sorted_by_region(
        Client $client,
        ResponseParser $responseParser,
        CacheProvider $cacheProvider
    ) {
        $expectedReturnValue = TestBankHolidaysData::getBankHolidaysSortedByRegion();

        $responseBody = TestResponseBodyFactory::buildWellFormedResponseJson();
        $decodedResponse = json_decode($responseBody, true);

        $client->getBankHolidays()->willReturn($responseBody);
        $responseParser->decodeResponse($responseBody)->willReturn($decodedResponse);

        $cacheProvider->has(BankHolidayService::CACHE_KEY_BY_REGION)->willReturn(false);
        $cacheProvider->has(BankHolidayService::CACHE_KEY_RAW_DATA)->willReturn(false);
        $cacheProvider->set(BankHolidayService::CACHE_KEY_BY_REGION, Argument::type('array'))->shouldBeCalled();
        $cacheProvider->set(BankHolidayService::CACHE_KEY_RAW_DATA, Argument::type('array'))->shouldBeCalled();

        $this->getBankHolidaysSortedByRegion()->shouldBe($expectedReturnValue);
    }
}
