<?php

namespace Inviqa\UKBankHolidays;

interface Configuration
{
    public function isTestMode(): bool;

    public function getExtraConfig(): array;
}
