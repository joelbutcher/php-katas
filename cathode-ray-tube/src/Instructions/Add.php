<?php

namespace JoelButcher\CathodeRayTube\Instructions;

use Generator;
use JoelButcher\CathodeRayTube\CpuCycle;

final readonly class Add extends Instruction
{
    public function cycles(): Generator
    {
        yield new CpuCycle();
        yield new CpuCycle($this->value);
    }

    public static function new(): static
    {
        $args = func_get_args();

        if (count($args) < 1) {
            throw new \InvalidArgumentException('Invalid number of arguments');
        }

        $value = head($args);

        return new self($value);
    }
}
