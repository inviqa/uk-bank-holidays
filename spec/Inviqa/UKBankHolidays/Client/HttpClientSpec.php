<?php

namespace spec\Inviqa\UKBankHolidays\Client;

use GuzzleHttp\Client;
use Inviqa\UKBankHolidays\Client\HttpClient;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use TestService\TestResponseBodyFactory;

class HttpClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(HttpClient::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_makes_requests_to_the_bank_holiday_service_and_returns_the_json_response_body(
        Client $client,
        ResponseInterface $response,
        StreamInterface $body
    ) {
        $responseBody = TestResponseBodyFactory::buildWellFormedResponseJson();

        $body->getContents()->willReturn($responseBody);
        $response->getBody()->willReturn($body);

        $client->get(HttpClient::SERVICE_URL)->willReturn($response);

        $this->getBankHolidays()->shouldBe($responseBody);
    }
}
