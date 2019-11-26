<?php

namespace spec\Inviqa\UKBankHolidays;

use Inviqa\UKBankHolidays\Exception\UnknownResponseException;
use Inviqa\UKBankHolidays\ResponseParser;
use PhpSpec\ObjectBehavior;
use TestService\TestResponseBodyFactory;

class ResponseParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ResponseParser::class);
    }

    function it_decodes_a_well_formed_response_json_and_returns_an_array()
    {
        $responseBody = TestResponseBodyFactory::buildWellFormedResponseJson();

        $this->decodeResponse($responseBody)->shouldBeArray();
    }

    function it_throws_an_exception_when_trying_to_decode_a_malformed_json_response()
    {
        $responseBody = TestResponseBodyFactory::buildMalformedResponseJson();
        $expectedException = UnknownResponseException::withResponseBody($responseBody);


        $this->shouldThrow($expectedException)->during('decodeResponse', [$responseBody]);
    }
}