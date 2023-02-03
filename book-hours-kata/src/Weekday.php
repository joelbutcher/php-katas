<?php

namespace App;

use DateTimeImmutable;

enum Weekday: string
{
    case Monday = 'Monday';
    case Tuesday = 'Tuesday';
    case Wednesday = 'Wednesday';
    case Thursday = 'Thursday';
    case Friday = 'Friday';
    case Saturday = 'Saturday';
    case Sunday = 'Sunday';

    public static function fromDate(DateTimeImmutable $date): self
    {
        return self::from(
            value: $date->format('l'),
        );
    }

    public function next(): Weekday
    {
        return match ($this) {
            self::Monday => Weekday::Tuesday,
            self::Tuesday => Weekday::Wednesday,
            self::Wednesday => Weekday::Thursday,
            self::Thursday => Weekday::Friday,
            self::Friday => Weekday::Saturday,
            self::Saturday => Weekday::Sunday,
            self::Sunday => Weekday::Monday,
        };
    }

    public function defaultSchedule(): ?Schedule
    {
        return match ($this) {
            self::Monday, self::Wednesday, self::Friday => Schedule::from(
                start: DateTimeImmutable::createFromFormat('H:i', '08:00'),
                end: DateTimeImmutable::createFromFormat('H:i', '16:00'),
            ),
            default => null,
        };
    }
}
