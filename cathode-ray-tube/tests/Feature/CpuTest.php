<?php

namespace JoelButcher\CathodeRayTube\Tests\Feature;

use JoelButcher\CathodeRayTube\Cpu;
use JoelButcher\CathodeRayTube\Program;
use JoelButcher\CathodeRayTube\Register;

test('value and signal strength matches expected for tick', function (int $tick, int $expectedValue, int $expectedSignalStrength) {
    $cpu = new Cpu(
        register: $register = Register::new()
    );

    $cpu->loadProgram(new Program(__DIR__.'/../../input.txt'))
        ->execute();

    expect($register->valueAtTick($tick))->toEqual($expectedValue)
        ->and($register->signalStrength($tick))->toEqual($expectedSignalStrength);
})->with(fn () => [
    [20, 21, 420],
    [60, 19, 1140],
    [100, 18, 1800],
    [140, 21, 2940],
    [180, 16, 2880],
    [220, 18, 3960],
]);

test('sum of interested six signal strengths is correct', function () {
    $cpu = new Cpu(
        register: $register = Register::new()
    );

    $cpu->loadProgram(new Program(__DIR__.'/../../input.txt'))
        ->execute();

    $sum = collect([20, 60, 100, 140, 180, 220])
        ->reduce(
            callback: fn ($carry, $tick) => $carry + $register->signalStrength($tick),
            initial: 0
        );

    expect($sum)->toEqual(13140);
});
