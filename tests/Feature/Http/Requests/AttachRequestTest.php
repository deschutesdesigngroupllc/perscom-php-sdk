<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Attach\AttachRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Repositories\ArrayStore;
use Saloon\Repositories\Body\JsonBodyRepository;

beforeEach(function () {
    Config::preventStrayRequests();
});

test('it properly forms the request body and query', function () {
    $mockClient = new MockClient([
        AttachRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);

    $response = $connector->forms()->fields(1)->attach(
        resources: [
            new ResourceObject(1, [
                'foo' => 'bar',
            ]),
            new ResourceObject(2),
        ],
        include: ['submissions'],
        allowDuplicates: true,
    );

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof AttachRequest
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'include' => 'submissions',
            ]
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() === [
                'resources' => [
                    1 => ['foo' => 'bar'],
                    2 => [],
                ],
                'duplicates' => true,
            ];
    });
});
