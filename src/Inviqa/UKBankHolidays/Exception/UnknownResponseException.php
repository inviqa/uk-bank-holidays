<?php

namespace Inviqa\UKBankHolidays\Exception;

class UnknownResponseException extends UKBankHolidaysException
{
    public const UNKNOWN_RESPONSE_MESSAGE = 'Unknown response returned: "%s"';

    public static function withResponseBody(?string $responseBody): UnknownResponseException
    {
        $exception = new static(sprintf(self::UNKNOWN_RESPONSE_MESSAGE, $responseBody));

        return $exception;
    }
}
