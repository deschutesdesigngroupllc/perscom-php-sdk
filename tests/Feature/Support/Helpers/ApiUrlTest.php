<?php

declare(strict_types=1);

use Perscom\Exceptions\InvalidArgumentException;
use Perscom\PerscomConnection;
use Perscom\Support\Helpers\ApiUrl;

beforeEach(function () {
    $this->apiUrl = PerscomConnection::$apiUrl;
});

afterEach(function () {
    PerscomConnection::$apiUrl = $this->apiUrl;
});

it('can remove the API version from the API url', function () {
    PerscomConnection::$apiUrl = 'https://foo.bar/v1';

    expect(ApiUrl::withoutApiVersion(fn (string $baseUrl): string => $baseUrl))->toBe('https://foo.bar');
});

it('will throw an exception if the API url is missing a scheme or host', function () {
    PerscomConnection::$apiUrl = 'foo/v1';

    ApiUrl::withoutApiVersion(fn (string $baseUrl): string => $baseUrl);
})->throws(InvalidArgumentException::class);
