<?php

namespace Domain;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
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
     * @Given the :arg1 is not a bank holiday
     */
    public function theIsNotABankHoliday($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the result should be false
     */
    public function theResultShouldBeFalse()
    {
        throw new PendingException();
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
        $this->result = $this->application->check(\DateTime::createFromFormat('Y-m-d', $date), $region);
    }

    /**
     * @Given the :date is not a bank holiday in :region
     */
    public function theIsNotABankHolidayIn($date, $region)
    {
    }
}
