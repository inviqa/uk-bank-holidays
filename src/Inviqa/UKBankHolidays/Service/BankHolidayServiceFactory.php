<?php

namespace Inviqa\UKBankHolidays\Service;

use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Client\ClientFactory;
use Inviqa\UKBankHolidays\Configuration;
use Inviqa\UKBankHolidays\ResponseParser;

class BankHolidayServiceFactory
{
    public static function buildFrom(Configuration $configuration, CacheProvider $cacheProvider): BankHolidayService
    {
        $apiClient = ClientFactory::buildFrom($configuration);
        $responseParser = new ResponseParser();

        return new BankHolidayService(
            $apiClient,
            $responseParser,
            $cacheProvider
        );
    }
}
