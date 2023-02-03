Feature: Shop opening hours
  As a customer
  I want to know if the shop is open
  And when the next opening is

  Scenario: Check if the shop is open on Wednesday
    Given the current date is Wednesday
    When I check if the shop is open
    Then the shop should be open

  Scenario: Check if the shop is closed on Thursday
    Given the current date is Thursday
    When I check if the shop is open
    Then the shop should be closed

  Scenario: Get the next opening date
    Given the current date is Wednesday
    When I check the next opening date
    Then the next opening date should be Friday morning
