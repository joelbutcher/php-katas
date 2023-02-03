<?php

namespace App;

use DateInterval;
use DateTimeImmutable;

class OpeningHoursService
{
    private static array $openingHours = [];

    public static function setHoursForWeekday(Weekday $weekday, DateTimeImmutable $start, DateTimeImmutable $end)
    {
        static::$openingHours[$weekday->value] = Schedule::from(
            start: $start,
            end: $end,
        );
    }

    /**
     * This checks if the shop is open on a certain date and returns a boolean flag to indiciate if its open or not
     *
     * @param DateTimeImmutable $date
     * @return bool
     */
    public static function isOpenOn(DateTimeImmutable $date): bool
    {
        return self::scheduleForWeekday(
            weekday: Weekday::fromDate(date: $date),
        )
            ?->setDate(date: $date)
            ?->isOpenOn(date: $date)
            ?? false;
    }

    /**
     * This is what will be displayed on the billboard so we expect a string so that Amy & Valerie can just display the result
     *
     * @param DateTimeImmutable $date
     * @return string
     */
    public static function nextOpeningDate(DateTimeImmutable $date): string
    {
        $iterations = 0;
        $weekday = Weekday::fromDate(
            date: $date,
        );

        do {
            // Skip today and get the next schedule.
            $schedule = self::scheduleForWeekday(
                weekday: $weekday->next(),
            );

            $iterations++;
            $weekday = $weekday->next();
        } while (is_null($schedule));

        $schedule->setDate(
            date: $date->add(
                interval: DateInterval::createFromDateString(
                    datetime: "$iterations day",
                ),
            ),
        );

        return $schedule->start()->format('Y-m-d H:i:s');
    }

    private static function scheduleForWeekday(Weekday $weekday): ?Schedule
    {
        return self::$openingHours[$weekday->value] ?? $weekday->defaultSchedule();
    }
}
