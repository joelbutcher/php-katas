<?php

namespace JoelButcher\CathodeRayTube;

use JoelButcher\CathodeRayTube\Instructions\Instruction;

final readonly class Cpu
{
    private Program $program;

    public function __construct(
        private Register $register
    ) {
    }

    public function loadProgram(Program $program): self
    {
        $this->program = $program;

        return $this;
    }

    public function execute(): void
    {
        foreach ($this->program->getInstructions() as $instruction) {
            $this->executeInstruction($instruction);
        }
    }

    public function register(): Register
    {
        return $this->register;
    }

    public function signalStrength(?int $atTick = null): int
    {
        return $this->register->signalStrength($atTick);
    }

    private function executeInstruction(Instruction $instruction): void
    {
        foreach ($instruction->cycles() as $cycle) {
            $this->tick($cycle);
        }
    }

    private function tick(CpuCycle $cycle): void
    {
        $this->register->apply($cycle);
    }
}
