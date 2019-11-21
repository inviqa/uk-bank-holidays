<?php

namespace Inviqa\UKBankHolidays\Client;

interface ApiClient
{
    public function getBankHolidays(): string;
}
