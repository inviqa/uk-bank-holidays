<?php

namespace Inviqa\UKBankHolidays;

use Inviqa\UKBankHolidays\Exception\UnknownResponseException;
use function json_decode;

class ResponseParser
{
    public function extractResultFrom(string $responseBody): Result
    {
        $decodedResponse = json_decode($responseBody, true);

        if (!is_array($decodedResponse)) {
            throw UnknownResponseException::withResponseBody($responseBody);
        }

        return Result::successFromArray($decodedResponse);
    }
}
