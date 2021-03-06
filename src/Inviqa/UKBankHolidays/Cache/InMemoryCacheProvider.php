<?php

namespace Inviqa\UKBankHolidays\Cache;

class InMemoryCacheProvider implements CacheProvider
{
    private $cache = [];

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->cache);
    }

    /**
     * @inheritdoc
     */
    public function set(string $key, $value)
    {
        $this->cache[$key] = $value;
    }

    /**
     * @inheritdoc
     */
    public function get(string $key)
    {
        return $this->has($key) ? $this->cache[$key] : null;
    }

    public function delete(string $key)
    {
        if ($this->has($key)) {
            unset($this->cache[$key]);
        }
    }

    public function flush()
    {
        $this->cache = [];
    }
}