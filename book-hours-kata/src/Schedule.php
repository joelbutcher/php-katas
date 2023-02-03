<?php

namespace App;

use DateTimeImmutable;

class Schedule
{
    public function __construct(
        private DateTimeImmutable $start,
        private DateTimeImmutable $end
    ) {
    }

    public static function from(DateTimeImmutable $start, DateTimeImmutable $end): self
    {
        return new self(
            start: $start,
            end: $end,
        );
    }

    public function setDate(DateTimeImmutable $date): self
    {
        $this->start = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf(
            '%s %s', $date->format('Y-m-d'), $this->start->format('H:i:s')
        ));

        $this->end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf(
            '%s %s', $date->format('Y-m-d'), $this->end->format('H:i:s')
        ));

        return $this;
    }

    public function isOpenOn(DateTimeImmutable $date): bool
    {
        return $this->start < $date && $this->end > $date;
    }

    public function start(): DateTimeImmutable
    {
        return $this->start;
    }

    public function end(): DateTimeImmutable
    {
        return $this->end;
    }
}
