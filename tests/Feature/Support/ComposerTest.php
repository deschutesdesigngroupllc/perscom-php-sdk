<?php

use Perscom\Support\Composer;

test('it can retrieve the installed package version', function () {
    $version = Composer::getPerscomPackageVersion('pestphp/pest');

    expect(! is_null($version))->toBeTrue();
});