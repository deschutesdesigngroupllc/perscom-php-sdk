<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
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
        BatchDeleteRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->batchDelete([
        new ResourceObject(id: 1),
        new ResourceObject(id: 2),
    ]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() === [
                'resources' => [1, 2],
            ];
    });
});
