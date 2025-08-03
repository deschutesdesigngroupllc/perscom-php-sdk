<?php

declare(strict_types=1);

use Perscom\Http\Requests\Crud\UpdateRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Repositories\Body\JsonBodyRepository;

beforeEach(function () {
    Config::preventStrayRequests();
});

test('it properly forms the request body', function () {
    $mockClient = new MockClient([
        UpdateRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->update(1, [
        'foo' => 'bar',
    ]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() === [
                'foo' => 'bar',
            ];
    });
});
