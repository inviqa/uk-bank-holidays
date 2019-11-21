<?php

namespace Inviqa\UKBankHolidays;

use Inviqa\UKBankHolidays\Client\ApiClientFactory;

class BankHolidayServiceFactory
{
    public static function buildFrom(Configuration $configuration): BankHolidayService
    {
        $apiClient = ApiClientFactory::buildFrom($configuration);
        $responseParser = new ResponseParser();

        return new BankHolidayService(
            $apiClient,
            $responseParser
        );
    }
}
