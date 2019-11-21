<?php

namespace Inviqa\UKBankHolidays;

interface Configuration
{
    public function getDomain(): string;

    public function isTestMode(): bool;
}
