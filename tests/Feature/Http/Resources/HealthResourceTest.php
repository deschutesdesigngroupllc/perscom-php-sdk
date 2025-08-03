<?php

declare(strict_types=1);

use Perscom\Http\Requests\HealthRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        HealthRequest::class => MockResponse::make([
            'status' => 'ok',
            'version' => '1.0.0',
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get the health status', function () {
    $response = $this->connector->health()->get();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'status' => 'ok',
            'version' => '1.0.0',
        ]);

    $this->mockClient->assertSent(HealthRequest::class);
});
