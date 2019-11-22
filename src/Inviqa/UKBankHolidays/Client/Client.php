<?php

namespace Inviqa\UKBankHolidays\Client;

interface Client
{
    public function getBankHolidays(): string;
}
