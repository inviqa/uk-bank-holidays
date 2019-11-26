<?php

namespace spec\Inviqa\UKBankHolidays\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\StreamInterface;
use Inviqa\UKBankHolidays\Client\HttpClient;
use PhpSpec\ObjectBehavior;
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
        Response $response,
        StreamInterface $body
    ) {
        $responseBody = TestResponseBodyFactory::buildWellFormedResponseJson();

        $body->getContents()->willReturn($responseBody);
        $response->getBody()->willReturn($body);


        $client->get(HttpClient::SERVICE_URL)->willReturn($response);

        $this->getBankHolidays()->shouldBe($responseBody);
    }
}
