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

    function it_fetches_bank_holidays_and_returns_them(
        Client $client,
        ResponseParser $responseParser,
        CacheProvider $cacheProvider
    ) {
        $expectedReturnValue = TestBankHolidaysData::getBankHolidays();

        $responseBody = TestResponseBodyFactory::buildWellFormedResponseJson();
        $decodedResponse = json_decode($responseBody, true);

        $client->getBankHolidays()->willReturn($responseBody);
        $responseParser->decodeResponse($responseBody)->willReturn($decodedResponse);

        $cacheProvider->has(Argument::type('string'))->willReturn(false);
        $cacheProvider->set(Argument::type('string'), Argument::type('array'))->shouldBeCalled();

        $this->getBankHolidays()->shouldBe($expectedReturnValue);
    }
}
