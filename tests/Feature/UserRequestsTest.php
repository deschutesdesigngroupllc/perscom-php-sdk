<?php

use Perscom\PerscomConnection;
use Saloon\Http\Response;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Helpers\Config;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        MockResponse::make([
            'name' => 'foo'
        ], 200),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users', function () {
    $response = $this->connector->users()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);
});
