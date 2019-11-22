<?php

namespace spec\Inviqa\UKBankHolidays\Exception;

use Inviqa\UKBankHolidays\Exception\UnknownRegionException;
use Inviqa\UKBankHolidays\Region\Region;
use PhpSpec\ObjectBehavior;

class UnknownRegionExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnknownRegionException::class);
    }

    function it_can_be_constructed_with_a_region(Region $region)
    {
        $regionName = 'alderaan';

        $region->getRegion()->willReturn($regionName);

        $this->beConstructedWithRegion($region);
        $this->getMessage()->shouldBe(sprintf(UnknownRegionException::UNKNOW_REGION_MESSAGE, $regionName));
    }
}
