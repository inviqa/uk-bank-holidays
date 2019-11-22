<?php

namespace Inviqa\UKBankHolidays\Cache;

class InMemoryCacheProvider implements CacheProvider
{
    private $cache = [];

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->cache);
    }

    public function set(string $key, $value)
    {
        $this->cache[$key] = $value;
    }

    public function get(string $key)
    {
        if ($this->has($key)) {
            return $this->cache[$key];
        }
    }

    public function delete(string $key)
    {
        if ($this->has($key)) {
            unset $this->cache[$key];
        }
    }

    public function flush()
    {
        $this->cache = [];
    }
}