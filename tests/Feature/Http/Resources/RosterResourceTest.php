<?php

declare(strict_types=1);

use Perscom\Enums\RosterType;
use Perscom\Http\Resources\RosterResource;
use Perscom\PerscomConnection;

it('can set the roster type', function () {
    $connector = new PerscomConnection('foo', 'bar');

    $roster = new RosterResource($connector);
    $roster->setType(RosterType::Manual);

    expect($roster->getType())->toEqual(RosterType::Manual);
});
