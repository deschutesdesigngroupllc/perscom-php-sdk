<?php

declare(strict_types=1);

use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Search\SearchRequest;
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
        SearchRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);

    $response = $connector->users()->search(
        value: 'foo',
        sort: new SortObject('created_at', 'desc'),
        filter: [
            new FilterObject('created_at', '<', '2000-01-01'),
        ],
        scope: new ScopeObject('foobar', [
            'foo' => 'bar',
        ]),
        include: ['bar'],
        limit: 23
    );

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchRequest
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'limit' => 23,
                'page' => 1,
                'include' => 'bar',
            ]
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() === [
                'search' => [
                    'value' => 'foo',
                ],
                'sort' => [
                    [
                        'field' => 'created_at',
                        'direction' => 'desc',
                    ],
                ],
                'filters' => [
                    [
                        'field' => 'created_at',
                        'operator' => '<',
                        'value' => '2000-01-01',
                        'type' => 'or',
                    ],
                ],
                'scopes' => [
                    [
                        'name' => 'foobar',
                        'parameters' => [
                            'foo' => 'bar',
                        ],
                    ],
                ],
            ];
    });
});
