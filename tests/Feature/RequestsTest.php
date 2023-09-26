<?php

use Perscom\PerscomConnection;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;
use Saloon\Helpers\Config;

beforeEach(function () {
    Config::preventStrayRequests();
});

test('it will fail without defining the authenticator', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'message' => 'Unauthenticated'
        ], 401),
    ]);

    $connector = new PerscomConnection();
    $connector->withMockClient($mockClient);
    $response = $connector->users()->all();

    $data = $response->json();

    expect($response->status())->toEqual(401)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'message' => 'Unauthenticated',
        ]);
});