<?php

namespace spec\Inviqa\UKBankHolidays;

use Inviqa\UKBankHolidays\Application;
use Inviqa\UKBankHolidays\Cache\CacheProvider;
use Inviqa\UKBankHolidays\Configuration;
use PhpSpec\ObjectBehavior;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Application::class);
    }

    function let(Configuration $configuration, CacheProvider $cacheProvider)
    {
        $configuration->isTestMode()->willReturn(true);
        $this->beConstructedWith($configuration, $cacheProvider);
    }
}
