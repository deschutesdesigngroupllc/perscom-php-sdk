<?php

use Perscom\PerscomConnection;

test('it will resolve the default base url', function () {
    $connection = new PerscomConnection('foo', 'bar');

    expect($connection->resolveBaseUrl())->toEqual('https://api.perscom.io/v1');
});

test('it will resolve a custom base url', function () {
    $connection = new PerscomConnection('foo', 'bar', 'http://foo.bar');

    expect($connection->resolveBaseUrl())->toEqual('http://foo.bar');
});

test('it will leave the sdk version out of the default headers', function () {
    $connection = new PerscomConnection('foo', 'bar');

    expect(array_keys($connection->headers()->all()))
        ->toBeArray()
        ->toMatchArray([
            'X-Perscom-Sdk',
            'X-Perscom-Id',
            'X-Perscom-Sdk-Version'
        ]);
});
