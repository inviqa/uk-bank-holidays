<?php

namespace spec\Inviqa\UKBankHolidays\Exception;

use DateTime;
use Inviqa\UKBankHolidays\Exception\InvalidDateRangeException;
use PhpSpec\ObjectBehavior;

class InvalidDateRangeExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidDateRangeException::class);
    }

    function it_can_be_constructed_with_a_date_range(DateTime $from, DateTime $to)
    {
        $fromString = '2019-06-06';
        $toString = '2019-08-08';

        $from->format('Y-m-d')->willReturn($fromString);
        $to->format('Y-m-d')->willReturn($toString);

        $this->beConstructedWithDates($from, $to);
        $this->getMessage()->shouldBe(sprintf(InvalidDateRangeException::INVALID_DATE_RANGE_MESSAGE, $toString, $fromString));
    }
}
