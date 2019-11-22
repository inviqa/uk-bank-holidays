<?php

namespace spec\Inviqa\UKBankHolidays\Cache;

use Inviqa\UKBankHolidays\Cache\DummyCacheProvider;
use PhpSpec\ObjectBehavior;

class DummyCacheProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DummyCacheProvider::class);
    }

    function it_returns_false_for_any_key()
    {
        $key1 = 'hakuna_matata';
        $key2 = "I'be back";

        $this->has($key1)->shouldReturn(false);
        $this->has($key2)->shouldReturn(false);
    }

    function it_returns_null_for_any_key()
    {
        $key1 = 'hakuna_matata';
        $key2 = "I'be back";

        $this->get($key1)->shouldReturn(null);
        $this->get($key2)->shouldReturn(null);
    }
}
