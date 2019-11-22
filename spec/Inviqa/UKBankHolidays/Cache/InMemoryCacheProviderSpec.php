<?php

namespace spec\Inviqa\UKBankHolidays\Cache;

use Inviqa\UKBankHolidays\Cache\InMemoryCacheProvider;
use PhpSpec\ObjectBehavior;

class InMemoryCacheProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryCacheProvider::class);
    }

    function it_returns_true_if_a_key_exists_in_the_cache()
    {
    }

    function it_returns_false_if_a_key_does_not_exist_in_the_cache()
    {
    }

    function it_adds_a_value_to_the_cache_for_a_key()
    {
    }

    function it_returns_the_value_for_a_key()
    {
    }

    function it_returns_null_if_there_is_no_value_for_a_key()
    {
    }

    function it_deletes_a_value_for_a_key()
    {
    }

    function it_flushes_the_cache()
    {
    }
}
