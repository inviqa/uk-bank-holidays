<?php

namespace Inviqa\UKBankHolidays;

use Inviqa\UKBankHolidays\Exception\UnknownResponseException;
use function json_decode;

class ResponseParser
{
    public function decodeResponse(string $responseBody): array
    {
        $decodedResponse = json_decode($responseBody, true);

        if (!is_array($decodedResponse)) {
            throw UnknownResponseException::withResponseBody($responseBody);
        }

        return $decodedResponse;
    }
}
