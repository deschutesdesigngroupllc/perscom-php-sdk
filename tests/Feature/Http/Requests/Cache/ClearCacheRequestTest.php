

<?php

use Perscom\Http\Requests\Cache\ClearCacheRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        ClearCacheRequest::class => MockResponse::make(),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can clear the API cache', function () {
    $response = $this->connector->cache()->clear();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class);

    $this->mockClient->assertSent(ClearCacheRequest::class);
});
