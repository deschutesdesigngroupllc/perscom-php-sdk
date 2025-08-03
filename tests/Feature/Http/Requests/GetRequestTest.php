<?php

declare(strict_types=1);

use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Repositories\ArrayStore;

beforeEach(function () {
    Config::preventStrayRequests();
});

test('it will send the proper parameters in a get all request', function () {
    $mockClient = new MockClient([
        GetAllRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all(['rank'], 5, 2);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetAllRequest
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'limit' => 2,
                'page' => 5,
                'include' => 'rank',
            ];
    });
});

test('it will send the proper parameters in a get request', function () {
    $mockClient = new MockClient([
        GetRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->get(1, ['rank']);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'include' => 'rank',
            ];
    });
});
