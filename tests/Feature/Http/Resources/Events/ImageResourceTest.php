<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\CreateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Crud\UpdateRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\Http\Resources\Events\ImageResource;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAllRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'event.jpg',
                    'url' => 'https://example.com/event.jpg',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'event.jpg',
                    'url' => 'https://example.com/event.jpg',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'event.jpg',
            'url' => 'https://example.com/event.jpg',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'event.jpg',
            'url' => 'https://example.com/event.jpg',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'updated_event.jpg',
            'url' => 'https://example.com/updated_event.jpg',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'event.jpg',
                    'url' => 'https://example.com/event.jpg',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'updated_event.jpg',
                    'url' => 'https://example.com/updated_event.jpg',
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);

    $this->resource = new ImageResource($this->connector, 'events/1/images');
});

test('it can get all event images', function () {
    $response = $this->resource->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'event.jpg',
                    'url' => 'https://example.com/event.jpg',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search event images', function () {
    $response = $this->resource->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'event.jpg',
                    'url' => 'https://example.com/event.jpg',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get an event image', function () {
    $response = $this->resource->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'event.jpg',
            'url' => 'https://example.com/event.jpg',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create an event image', function () {
    $response = $this->resource->create([
        'filename' => 'event.jpg',
        'url' => 'https://example.com/event.jpg',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'event.jpg',
            'url' => 'https://example.com/event.jpg',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['filename'] === 'event.jpg'
            && $request->data['url'] === 'https://example.com/event.jpg';
    });
});

test('it can update an event image', function () {
    $response = $this->resource->update(1, [
        'filename' => 'updated_event.jpg',
        'url' => 'https://example.com/updated_event.jpg',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'updated_event.jpg',
            'url' => 'https://example.com/updated_event.jpg',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['filename'] === 'updated_event.jpg'
            && $request->data['url'] === 'https://example.com/updated_event.jpg';
    });
});

test('it can delete an event image', function () {
    $response = $this->resource->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create event images', function () {
    $response = $this->resource->batchCreate(new ResourceObject(data: [
        'filename' => 'event.jpg',
        'url' => 'https://example.com/event.jpg',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'event.jpg',
                    'url' => 'https://example.com/event.jpg',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'events/1/images';
    });
});

test('it can batch update event images', function () {
    $response = $this->resource->batchUpdate(new ResourceObject(1, [
        'filename' => 'updated_event.jpg',
        'url' => 'https://example.com/updated_event.jpg',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'updated_event.jpg',
                    'url' => 'https://example.com/updated_event.jpg',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'events/1/images';
    });
});

test('it can batch delete event images', function () {
    $response = $this->resource->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'events/1/images';
    });
});
