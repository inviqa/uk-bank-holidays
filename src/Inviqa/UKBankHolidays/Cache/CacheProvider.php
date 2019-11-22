<?php

namespace Inviqa\UKBankHolidays\Cache;

interface CacheProvider
{
    public function has(string $key): bool;

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set(string $key, $value);

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);

    public function delete(string $key);

    public function flush();
}