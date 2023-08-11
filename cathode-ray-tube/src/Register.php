<?php

namespace JoelButcher\CathodeRayTube;

use Illuminate\Support\Collection;
use Iterator;

final class Register implements Iterator
{
    public function __construct(
        private int $pointer = 0,
        public readonly Collection $cycles = new Collection([
            1,
        ]),
    ) {
    }

    public static function new(): self
    {
        return new self();
    }

    public function apply(CpuCycle $cycle): void
    {
        $this->cycles->add($cycle->value);
    }

    public function current(): mixed
    {
        return $this->cycles->get($this->pointer);
    }

    public function next(): void
    {
        $this->pointer = $this->pointer + 1;
    }

    public function key(): int
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return $this->cycles->has($this->pointer);
    }

    public function rewind(): void
    {
        $this->pointer = $this->cycles->count() - 1;
    }

    public function valueAtTick(?int $tick = null): int
    {
        return $this->cycles->slice(0, $tick)
            ->filter(fn (?int $cycleValue) => !is_null($cycleValue))
            ->sum(fn (?int $cycleValue) => $cycleValue);
    }

    public function signalStrength(?int $position = null): int
    {
        $position = $position ?: $this->cycles->count();

        return $position * $this->valueAtTick($position);
    }
}
