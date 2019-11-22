<?php

namespace spec\Inviqa\UKBankHolidays\Region;

use Inviqa\UKBankHolidays\Region\EnglandAndWales;
use PhpSpec\ObjectBehavior;

class EnglandAndWalesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EnglandAndWales::class);
    }

    function it_returns_the_code_of_the_region()
    {
        $code = 'england-and-wales';

        $this->getRegion()->shouldReturn($code);
    }
}
