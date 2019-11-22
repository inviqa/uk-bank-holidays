<?php

namespace spec\Inviqa\UKBankHolidays\Region;

use Inviqa\UKBankHolidays\Region\Scotland;
use PhpSpec\ObjectBehavior;

class ScotlandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Scotland::class);
    }

    function it_returns_the_code_of_the_region()
    {
        $code = 'scotland';

        $this->getRegion()->shouldReturn($code);
    }
}
