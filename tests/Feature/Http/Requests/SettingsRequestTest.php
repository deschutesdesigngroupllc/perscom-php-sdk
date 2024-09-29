<?php

declare(strict_types=1);

use Perscom\Http\Requests\SettingsRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        SettingsRequest::class => MockResponse::make(status: 200),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get settings', function () {
    $response = $this->connector->settings()->all();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class);

    $this->mockClient->assertSent(SettingsRequest::class);
});
