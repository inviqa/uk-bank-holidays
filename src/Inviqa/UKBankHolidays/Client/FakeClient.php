<?php

namespace Inviqa\UKBankHolidays\Client;

use Inviqa\UKBankHolidays\Configuration;
use Inviqa\UKBankHolidays\Exception\UKBankHolidaysException;
use RuntimeException;

class FakeClient implements Client
{
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getBankHolidays(): string
    {
        $extraConfig = $this->configuration->getExtraConfig();

        $response = null;

        if (array_key_exists($extraConfig['testResults']['success'])) {
            $response = json_encode($extraConfig['testResults']['success']);
        }

        if (array_key_exists($resultChecksum, $extraConfig['testResults']['exception'])) {
            throw new UKBankHolidaysException($extraConfig['testResults']['exception'][$resultChecksum]['message']);
        }

        if ($response === null) {
            throw new RuntimeException(sprintf(
                'No matching predetermined result found for event ID %s and event key %s',
                $event->getEventId(),
                $event->getEventKey()
            ));
        }

        return $response;
    }
}
