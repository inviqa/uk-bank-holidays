<?php

namespace spec\Inviqa\UKBankHolidays\Service;

use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Client\Client;
use Inviqa\UKBankHolidays\ResponseParser;
use Inviqa\UKBankHolidays\Service\BankHolidayService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
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
        $expectedReturnValue = [
            '2019-12-25' => [
                'date'  => '2019-12-25',
                'title' => 'Christmas Day',
            ],
            '2019-12-26' => [
                'date'  => '2019-12-26',
                'title' => 'Boxing Day',
            ],
            '2020-01-01' => [
                'date'  => '2020-01-01',
                'title' => 'New Year’s Day',
            ],
        ];

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
        $expectedReturnValue = [
            'england-and-wales' => [
                '2019-12-25' => [
                    'date'  => '2019-12-25',
                    'title' => 'Christmas Day',
                ],
                '2019-12-26' => [
                    'date'  => '2019-12-26',
                    'title' => 'Boxing Day',
                ],
                '2020-01-01' => [
                    'date'  => '2020-01-01',
                    'title' => 'New Year’s Day',
                ],
            ],
            'scotland'          => [
                '2019-12-25' => [
                    'date'  => '2019-12-25',
                    'title' => 'Christmas Day',
                ],
                '2019-12-26' => [
                    'date'  => '2019-12-26',
                    'title' => 'Boxing Day',
                ],
                '2020-01-01' => [
                    'date'  => '2020-01-01',
                    'title' => 'New Year’s Day',
                ],
            ],
        ];

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
