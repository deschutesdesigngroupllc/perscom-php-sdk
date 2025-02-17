<?php

declare(strict_types=1);

arch()
    ->expect('Perscom')
    ->not->toUse(['die', 'dd', 'dump', 'ray', 'exit']);

arch()
    ->preset()
    ->strict()
    ->ignoring('Perscom\Http')
    ->ignoring('Perscom\PerscomConnection');
