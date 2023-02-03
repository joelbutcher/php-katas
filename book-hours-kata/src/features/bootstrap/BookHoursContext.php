<?php

namespace App\Features\Bootstrap;

use Behat\Behat\Context\Context;
use App\OpeningHoursService;
use Behat\Behat\Tester\Exception\PendingException;
use DateTimeImmutable;
use PHPUnit\Framework\Assert;


/**
 * Defines application features from the specific context.
 */
class BookHoursContext implements Context
{
    private DateTimeImmutable|null $currentDate;
    private bool $isOpen = false;
    private string $nextOpeningDay = '';

    /**
     * @Given /^the current date is Tuesday/
     */
    public function theCurrentDateIsTuesday(): void
    {
        $this->currentDate = new DateTimeImmutable('2023-01-31T13:00:00');
    }

    /**
     * @Given /^the current date is Wednesday$/
     */
    public function theCurrentDateIsWednesday(): void
    {
        $this->currentDate = new DateTimeImmutable('2023-02-01T13:00:00');
    }

    /**
     * @Given /^the current date is Thursday$/
     */
    public function theCurrentDateIsThursday(): void
    {
        $this->currentDate = new DateTimeImmutable('2023-02-02T13:00:00');
    }

    /**
     * @When /^I check if the shop is open$/
     */
    public function iCheckIfTheShopIsOpen(): void
    {
        $this->isOpen = OpeningHoursService::isOpenOn(
            date: $this->currentDate
        );
    }

    /**
     * @When /^I check the next opening date$/
     */
    public function iCheckTheNextOpeningDate(): void
    {
         $this->nextOpeningDay  = OpeningHoursService::nextOpeningDate(
             date: $this->currentDate
         );
    }

    /**
     * @Then /^the next opening date should be Friday morning$/
     */
    public function theNextOpeningDateShouldBeFridayMorning(): void
    {
       Assert::assertEquals('2023-02-03 08:00:00', $this->nextOpeningDay);
    }

    /**
     * @Then /^the shop should be closed$/
     */
    public function theShopShouldBeClosed(): void
    {
        Assert::assertFalse($this->isOpen);
    }

    /**
     * @Then /^the shop should be open$/
     */
    public function theShopShouldBeOpen(): void
    {
        Assert::assertTrue($this->isOpen);
    }
}
