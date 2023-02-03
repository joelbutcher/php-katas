# book-hours-kata

## Introduction 
Amy and Valerie, the shop owners, need you to develop a simple program that satisfies the following requirements:

The opening days and hours of the shop need to be configurable, and can be scattered in the week (e.g. Mon, Wed, Fri from 08:00 to 16:00)
Amy needs to display the date of the next opening on a billboard outside of the shop
Amy also wants to display on the website of the shop whether it is opened or closed at the moment
Write a small module that follows this contract, so that Valerie can easily integrate it:

```
OpeningHours::isOpenOn(DateTimeImmutable $date)
OpeningHours::nextOpeningDate(DateTimeImmutable $date)
```

## Test Cases

Let's assume for now that the shop has peculiar opening days of Monday, Wednesday and Friday between 08:00 and 16:00 hours.

If we were to give the following test cases: 

```
Shop opening days at the moment: Mon, Wed, Fri
Shop opening hours at the moment: 08:00 - 16:00

(note ideally the above should be configurable as described in Steps to solve)

wednesday = '2023-02-01T13:00:00'
wednesdayAfterHours = '2023-02-01T18:00:00'
thursday = '2023-02-02T13:00:00'
fridayMorning = '2023-02-03T08:00:00'

```

If we call the module, we expect the following responses:

```
OpeningHoursService::isOpenOn(wednesday) => true
OpeningHoursService::isOpenOn(wednesdayAfterHours) => false
OpeningHoursService::isOpenOn(thursday) => false
OpeningHoursService::nextOpeningDate(wednesday) => "2023-02-03 08:00:00"
```

## Steps to Solve

1. We have a simple behat feature which should be completed, you may edit as you want!
2. Implement the isOpenOn and nextOpeningDate methods in the OpeningHours service
3. Allow for the shop opening times to be configurable - this may impact your tests! :) 

Might be worth looking at Behat arguments [here](https://behat.org/en/latest/user_guide/context/definitions.html)

## Installation and running tests

You should be able to get started by just cloning the repo and running: 

1. composer install 
2. vendor/bin/behat
