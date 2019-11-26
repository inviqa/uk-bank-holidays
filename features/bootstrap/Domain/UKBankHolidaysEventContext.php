<?php

namespace Domain;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Inviqa\UKBankHolidays\Application;
use Inviqa\UKBankHolidays\Cache\DummyCacheProvider;
use TestService\TestConfiguration;

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
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $configuration = new TestConfiguration();
        $configuration->addSuccessEvent();
        $cacheProvider = new DummyCacheProvider();

        $this->application = new Application($configuration, $cacheProvider);
    }

    /**
     * @Given the :arg1 is a bank holiday
     */
    public function theIsABankHoliday($arg1)
    {
        assert();
    }

    /**
     * @When a developer checks if the date :arg1 is bank holiday
     */
    public function aDeveloperChecksIfTheDateIsBankHoliday($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the result should be true
     */
    public function theResultShouldBeTrue()
    {
        throw new PendingException();
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
     * @Given the :arg1 is a bank holiday in :arg2
     */
    public function theIsABankHolidayIn($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When a developer checks if the date :arg1 is bank holiday in :arg2
     */
    public function aDeveloperChecksIfTheDateIsBankHolidayIn($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given the :arg1 is not a bank holiday in :arg2
     */
    public function theIsNotABankHolidayIn($arg1, $arg2)
    {
        throw new PendingException();
    }
}
