<?php

declare(strict_types=1);

use Perscom\Http\Requests\RosterRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        RosterRequest::class => MockResponse::make(status: 200),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get the roster', function () {
    $response = $this->connector->roster()->all();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class);

    $this->mockClient->assertSent(RosterRequest::class);
});
