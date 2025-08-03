<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
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
        BatchUpdateRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->batchUpdate([
        new ResourceObject(id: 1, data: [
            'name' => 'foo',
        ]),
        new ResourceObject(id: 2, data: [
            'name' => 'bar',
        ]),
    ]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() === [
                'resources' => [
                    1 => ['name' => 'foo'],
                    2 => ['name' => 'bar'],
                ],
            ];
    });
});
