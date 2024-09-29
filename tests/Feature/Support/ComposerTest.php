<?php

declare(strict_types=1);

use Perscom\Support\Composer;

test('it can retrieve the installed package version', function () {
    $version = Composer::getPerscomPackageVersion('pestphp/pest');

    expect(! is_null($version))->toBeTrue();
});

test('it will return null if the package does not exists', function () {
    $version = Composer::getPerscomPackageVersion('foobar');

    expect(is_null($version))->toBeTrue();
});
