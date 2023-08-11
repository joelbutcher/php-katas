<?php

namespace JoelButcher\CathodeRayTube;

use Generator;
use JoelButcher\CathodeRayTube\Instructions\Instruction;

final readonly class Program
{
    public function __construct(
        private string $path
    ) {
    }

    public function getInstructions(): Generator
    {
        $f = fopen($this->path, 'r');

        while ($line = fgets($f)) {
            yield Instruction::fromString($line);
        }

        fclose($f);
    }
}
