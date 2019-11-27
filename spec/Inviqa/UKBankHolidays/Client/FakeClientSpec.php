<?php

namespace spec\Inviqa\UKBankHolidays\Client;

use Inviqa\UKBankHolidays\Client\FakeClient;
use Inviqa\UKBankHolidays\Configuration;
use PhpSpec\ObjectBehavior;
use TestService\TestResponseBodyFactory;

class FakeClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FakeClient::class);
    }

    function let(Configuration $configuration)
    {
        $this->beConstructedWith($configuration);
    }

    function it_makes_use_of_extra_configuration_to_return_a_well_formed_json_response(Configuration $configuration)
    {
        $responseBody = TestResponseBodyFactory::buildWellFormedResponseJson();

        $configuration->getExtraConfig()->willReturn([
            'response_body' => [
                'well-formed' => $responseBody
            ],
        ]);

        $this->getBankHolidays()->shouldBe($responseBody);
    }

    function it_makes_use_of_extra_configuration_to_return_a_malformed_json_response(Configuration $configuration)
    {
        $responseBody = TestResponseBodyFactory::buildMalformedResponseJson();

        $configuration->getExtraConfig()->willReturn([
            'response_body' => [
                'well-formed' => null,
                'malformed'   => $responseBody,
            ],
        ]);

        $this->getBankHolidays()->shouldBe($responseBody);
    }
}
