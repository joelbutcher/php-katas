<?php

namespace JoelButcher\CathodeRayTube\Instructions;

use Generator;
use InvalidArgumentException;

abstract readonly class Instruction
{
    public function __construct(public ?int $value = null)
    {
    }

    public static function new(): static
    {
        return new static();
    }

    public function value(): ?int
    {
        return $this->value;
    }

    abstract public function cycles(): Generator;

    public static function fromString(string $operation): static
    {
        return match (true) {
            str_starts_with($operation, 'noop') => NoOp::new(),
            str_starts_with($operation, 'addx') => new Add(
                value: (int) trim(str_replace('addx', '', $operation))
            ),
            default => throw new InvalidArgumentException('Invalid operation'),
        };
    }
}
