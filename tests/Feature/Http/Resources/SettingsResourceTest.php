<?php

declare(strict_types=1);

use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAllRequest::class => MockResponse::make([
            'data' => [
                [
                    'key' => 'site_name',
                    'value' => 'Test Site',
                    'type' => 'string',
                ],
                [
                    'key' => 'enable_notifications',
                    'value' => true,
                    'type' => 'boolean',
                ],
            ],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all settings', function () {
    $response = $this->connector->settings()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'key' => 'site_name',
                    'value' => 'Test Site',
                    'type' => 'string',
                ],
                [
                    'key' => 'enable_notifications',
                    'value' => true,
                    'type' => 'boolean',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can get settings with pagination', function () {
    $response = $this->connector->settings()->all([], 2, 10);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'key' => 'site_name',
                    'value' => 'Test Site',
                    'type' => 'string',
                ],
                [
                    'key' => 'enable_notifications',
                    'value' => true,
                    'type' => 'boolean',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});
