<?php

namespace Domain;

use Behat\Behat\Context\Context;
use DateInterval;
use DateTime;
use Inviqa\UKBankHolidays\Application;
use Inviqa\UKBankHolidays\Cache\DummyCacheProvider;
use TestService\TestConfiguration;
use Webmozart\Assert\Assert;

/**
 * Defines application features from the specific context.
 */
class UKBankHolidaysEventContext implements Context
{
    /**
     * @var Application
     */
    private $application;

    /**
     * @var TestConfiguration
     */
    private $configuration;

    /**
     * @var bool
     */
    private $result;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $cacheProvider = new DummyCacheProvider();
        $this->configuration = new TestConfiguration();
        $this->application = new Application($this->configuration, $cacheProvider);
    }

    /**
     * @Then the result should be true
     */
    public function theResultShouldBeTrue()
    {
        Assert::true($this->result);
    }

    /**
     * @Given the :date is not a bank holiday in :region
     */
    public function theIsNotABankHoliday($date, $region)
    {
        // add 3 days to passed date
        $origDate = DateTime::createFromFormat('Y-m-d', $date);
        $newDate = $origDate->add(new DateInterval('P3D'));

        $this->configuration->addBankHolidayResult($region, $newDate->format('Y-m-d'));
    }

    /**
     * @Then the result should be false
     */
    public function theResultShouldBeFalse()
    {
        Assert::false($this->result);
    }

    /**
     * @Given the :date is a bank holiday in :region
     */
    public function theIsABankHolidayIn($date, $region)
    {
        $this->configuration->addBankHolidayResult($region, $date);
    }

    /**
     * @When a developer checks if the date :date is bank holiday in :region
     */
    public function aDeveloperChecksIfTheDateIsBankHolidayIn($date, $region)
    {
        $this->result = $this->application->check(DateTime::createFromFormat('Y-m-d', $date), $region);
    }
}
