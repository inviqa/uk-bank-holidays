<?php

namespace spec\Inviqa\UKBankHolidays\Cache;

use Inviqa\UKBankHolidays\Cache\InMemoryCacheProvider;
use PhpSpec\ObjectBehavior;

class InMemoryCacheProviderSpec extends ObjectBehavior
{
    private const KEY = 'Kenny';
    private const KEY_NO = 'Cartman';
    private const VALUE = 'is dead';

    function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryCacheProvider::class);
    }

    function it_returns_true_if_a_key_exists_in_the_cache()
    {
        $this->set(self::KEY, self::VALUE);
        $this->has(self::KEY)->shouldReturn(true);

    }

    function it_returns_false_if_a_key_does_not_exist_in_the_cache()
    {
        $this->set(self::KEY, self::VALUE);
        $this->has(self::KEY_NO)->shouldReturn(false);
    }

    function it_adds_a_value_to_the_cache_for_a_key()
    {
        $this->set(self::KEY, self::VALUE);
        $this->has(self::KEY)->shouldReturn(true);
        $this->get(self::KEY)->shouldReturn(self::VALUE);
    }

    function it_returns_the_value_for_a_key()
    {
        $this->set(self::KEY, self::VALUE);
        $this->get(self::KEY)->shouldReturn(self::VALUE);
    }

    function it_returns_null_if_there_is_no_value_for_a_key()
    {
        $this->set(self::KEY, self::VALUE);
        $this->get(self::KEY_NO)->shouldReturn(null);
    }

    function it_deletes_a_value_for_a_key()
    {
        $this->set(self::KEY, self::VALUE);
        $this->has(self::KEY)->shouldReturn(true);
        $this->delete(self::KEY);
        $this->has(self::KEY)->shouldReturn(false);
    }

    function it_flushes_the_cache()
    {
        $this->set(self::KEY, self::VALUE);
        $this->has(self::KEY)->shouldReturn(true);
        $this->flush();
        $this->has(self::KEY)->shouldReturn(false);
    }
}
