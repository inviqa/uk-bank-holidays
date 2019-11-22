<?php

namespace spec\Inviqa\UKBankHolidays\Exception;

use Inviqa\UKBankHolidays\Exception\UnknownResponseException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnknownResponseExceptionSpec extends ObjectBehavior
{
    const EXAMPLE_RESPONSE_BODY = 'Erroneous response body!';

    function it_is_initializable()
    {
        $this->shouldHaveType(UnknownResponseException::class);
    }

    function it_can_easily_be_constructed_with_the_response_body()
    {
        $this->beConstructedWithResponseBody(self::EXAMPLE_RESPONSE_BODY);
        $this->getMessage()->shouldBe(sprintf(UnknownResponseException::UNKNOWN_RESPONSE_MESSAGE, self::EXAMPLE_RESPONSE_BODY));
    }
}
