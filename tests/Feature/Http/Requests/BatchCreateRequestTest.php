<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
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
        BatchCreateRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->batchCreate([
        new ResourceObject(data: [
            'name' => 'foo',
        ]),
        new ResourceObject(data: [
            'name' => 'bar',
        ]),
    ]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() === [
                'resources' => [
                    ['name' => 'foo'],
                    ['name' => 'bar'],
                ],
            ];
    });
});
