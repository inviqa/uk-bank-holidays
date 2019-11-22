<?php

namespace spec\Inviqa\UKBankHolidays;

use Inviqa\UKBankHolidays\Exception\UnknownRegionException;
use Inviqa\UKBankHolidays\Region;
use PhpSpec\ObjectBehavior;

class RegionSpec extends ObjectBehavior
{
    private const VALID_REGION = 'scotland';
    private const INVALID_REGION = 'alderaan';

    function it_is_initializable()
    {
        $this->shouldHaveType(Region::class);
    }

    function it_can_be_build_from_valid_region_string()
    {
        $this->beConstructedThrough('createFromString', [self::VALID_REGION]);
    }

    function it_throws_an_exception_when_tried_to_be_build_from_invalid_region_string()
    {
        $expectedException = UnknownRegionException::withRegion(self::INVALID_REGION);

        $this->beConstructedThrough('createFromString', [self::INVALID_REGION]);

        $this->shouldThrow($expectedException)->duringInstantiation();
    }
}
