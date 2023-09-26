<?php

use Perscom\Exceptions\AuthenticationException;
use Perscom\Exceptions\NotFoundHttpException;
use Perscom\Exceptions\TenantCouldNotBeIdentifiedException;
use Perscom\PerscomConnection;
use Saloon\Exceptions\Request\Statuses\UnauthorizedException;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;
use Saloon\Helpers\Config;

beforeEach(function () {
    Config::preventStrayRequests();
});

test('it will throw an exception on a failed request', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo',
                'type' => 'bar'
            ]
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $response = $connector->users()->all();

    $data = $response->json();

    expect($response->status())->toEqual(401)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'message' => 'Unauthenticated',
        ]);
})->throws(UnauthorizedException::class);

test('it will throw an authentication exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'AuthenticationException'
            ]
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(AuthenticationException::class);

test('it will throw a not found exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException'
            ]
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(NotFoundHttpException::class);

test('it will throw a tenant not identified exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'TenantCouldNotBeIdentified'
            ]
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(TenantCouldNotBeIdentifiedException::class);
