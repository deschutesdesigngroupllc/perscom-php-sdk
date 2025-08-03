<?php

declare(strict_types=1);

use Perscom\Exceptions\AuthenticationException;
use Perscom\Exceptions\ForbiddenException;
use Perscom\Exceptions\NotFoundHttpException;
use Perscom\Exceptions\PaymentRequiredException;
use Perscom\Exceptions\RateLimitException;
use Perscom\Exceptions\ServerErrorException;
use Perscom\Exceptions\ServiceUnavailableException;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    Config::preventStrayRequests();
});

test('it will throw an authentication exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'AuthenticationException',
            ],
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(AuthenticationException::class);

test('it will throw a payment require exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'AuthenticationException',
            ],
        ], 402),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(PaymentRequiredException::class);

test('it will throw a forbidden exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'AuthenticationException',
            ],
        ], 403),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(ForbiddenException::class);

test('it will throw a not found exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException',
            ],
        ], 404),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(NotFoundHttpException::class);

test('it will throw a rate limiter exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException',
            ],
        ], 429),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(RateLimitException::class);

test('it will throw a server error exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException',
            ],
        ], 500),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(ServerErrorException::class);

test('it will throw a service unavailable exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException',
            ],
        ], 503),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(ServiceUnavailableException::class);
