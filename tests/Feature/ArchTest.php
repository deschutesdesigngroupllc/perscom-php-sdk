<?php

declare(strict_types=1);

arch()
    ->expect('Perscom')
    ->not->toUse(['die', 'dd', 'dump', 'ray']);

arch()
    ->preset()
    ->strict()
    ->ignoring('Perscom\Http')
    ->ignoring('Perscom\PerscomConnection');
