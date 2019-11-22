<?php

namespace spec\Inviqa\UKBankHolidays\Exception;

use Inviqa\UKBankHolidays\Exception\UnknownRegionException;
use Inviqa\UKBankHolidays\Region\Region;
use PhpSpec\ObjectBehavior;

class UnknownRegionExceptionSpec extends ObjectBehavior
{
    private const INVALID_REGION = 'alderaan';

    function it_is_initializable()
    {
        $this->shouldHaveType(UnknownRegionException::class);
    }

    function it_can_be_constructed_with_a_region()
    {
        $this->beConstructedWithRegion(self::INVALID_REGION);
        $this->getMessage()->shouldBe(sprintf(UnknownRegionException::UNKNOW_REGION_MESSAGE, self::INVALID_REGION));
    }
}
