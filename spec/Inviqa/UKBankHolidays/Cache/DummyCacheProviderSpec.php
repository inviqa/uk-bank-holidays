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
    }

    function it_returns_null_for_any_key()
    {
    }
}
