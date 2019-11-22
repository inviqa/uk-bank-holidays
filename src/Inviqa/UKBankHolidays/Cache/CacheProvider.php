<?php

namespace Inviqa\UKBankHolidays\Cache;

interface CacheProvider
{
    public function has(string $key): bool;

    public function set(string $key, $value);

    public function get(string $key);

    public function delete(string $key);

    public function flush();
}