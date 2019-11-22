<?php

namespace spec\Inviqa\UKBankHolidays\Region;

use Inviqa\UKBankHolidays\Region\NorthernIreland;
use PhpSpec\ObjectBehavior;

class NorthernIrelandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NorthernIreland::class);
    }

    function it_returns_the_code_of_the_region()
    {
        $code = 'northern-ireland';

        $this->getRegion()->shouldReturn($code);
    }
}
