<?php

declare(strict_types=1);

use Perscom\Http\Requests\Cache\ClearCacheRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        ClearCacheRequest::class => MockResponse::make([
            'message' => 'Cache cleared successfully',
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can clear the cache', function () {
    $response = $this->connector->cache()->clear();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'message' => 'Cache cleared successfully',
        ]);

    $this->mockClient->assertSent(ClearCacheRequest::class);
});
