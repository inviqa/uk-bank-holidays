<?php

namespace spec\Inviqa\UKBankHolidays\Client;

use Inviqa\UKBankHolidays\Client\ClientFactory;
use Inviqa\UKBankHolidays\Client\FakeClient;
use Inviqa\UKBankHolidays\Client\HttpClient;
use Inviqa\UKBankHolidays\Configuration;
use PhpSpec\ObjectBehavior;

class ClientFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ClientFactory::class);
    }

    function it_builds_a_real_api_client_when_not_in_test_mode(Configuration $configuration)
    {
        $configuration->isTestMode()->willReturn(false);

        $this::buildFrom($configuration)->shouldBeAnInstanceOf(HttpClient::class);
    }

    function it_builds_a_fake_api_client_when_not_in_test_mode(Configuration $configuration)
    {
        $configuration->isTestMode()->willReturn(true);

        $this::buildFrom($configuration)->shouldBeAnInstanceOf(FakeClient::class);
    }
}
