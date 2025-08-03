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
                    'id' => 1,
                    'title' => 'Test News Item',
                    'content' => 'News content',
                    'published_at' => '2023-01-01T00:00:00Z',
                ],
            ],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get the newsfeed', function () {
    $response = $this->connector->newsfeed()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test News Item',
                    'content' => 'News content',
                    'published_at' => '2023-01-01T00:00:00Z',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can get the newsfeed with includes', function () {
    $response = $this->connector->newsfeed()->all(['user', 'category']);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test News Item',
                    'content' => 'News content',
                    'published_at' => '2023-01-01T00:00:00Z',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can get the newsfeed with pagination', function () {
    $response = $this->connector->newsfeed()->all([], 2, 10);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test News Item',
                    'content' => 'News content',
                    'published_at' => '2023-01-01T00:00:00Z',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});
