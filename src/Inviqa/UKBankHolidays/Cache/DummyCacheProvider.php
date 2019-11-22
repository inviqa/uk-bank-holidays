<?php

namespace Inviqa\UKBankHolidays\Cache;

class DummyCacheProvider implements CacheProvider
{
    public function has(string $key): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function set(string $key, $value)
    {
    }

    /**
     * @inheritdoc
     */
    public function get(string $key)
    {
        return null;
    }

    public function delete(string $key)
    {
    }

    public function flush()
    {
    }
}