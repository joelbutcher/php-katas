<?php

namespace JoelButcher\CathodeRayTube\Instructions;

use Generator;
use JoelButcher\CathodeRayTube\CpuCycle;

final readonly class NoOp extends Instruction
{
    public function cycles(): Generator
    {
        yield new CpuCycle();
    }

    public function value(): ?int
    {
        return null;
    }
}
