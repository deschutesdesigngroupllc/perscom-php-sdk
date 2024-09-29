<?php

declare(strict_types=1);

use Perscom\PerscomConnection;
use Perscom\Support\Helpers\ApiUrl;

it('can remove the API version from the API url', function () {
    PerscomConnection::$apiUrl = 'https://foo.bar/v1';

    ApiUrl::withoutApiVersion(fn ($baseUrl) => expect($baseUrl)->toBe('https://foo.bar'));
});
