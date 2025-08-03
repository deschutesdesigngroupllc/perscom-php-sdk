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
use Perscom\Http\Requests\Image\CreateImageRequest;
use Perscom\Http\Requests\Image\DeleteImageRequest;
use Perscom\Http\Requests\Image\GetImageRequest;
use Perscom\Http\Requests\Image\UpdateImageRequest;
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
                    'title' => 'Test Event',
                    'description' => 'Test Description',
                    'start_date' => '2023-01-01T10:00:00Z',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Event',
                    'description' => 'Test Description',
                    'start_date' => '2023-01-01T10:00:00Z',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Test Event',
            'description' => 'Test Description',
            'start_date' => '2023-01-01T10:00:00Z',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Test Event',
            'description' => 'Test Description',
            'start_date' => '2023-01-01T10:00:00Z',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Updated Event',
            'description' => 'Updated Description',
            'start_date' => '2023-01-02T10:00:00Z',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Event',
                    'description' => 'Test Description',
                    'start_date' => '2023-01-01T10:00:00Z',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Updated Event',
                    'description' => 'Updated Description',
                    'start_date' => '2023-01-02T10:00:00Z',
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
        GetImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        CreateImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        DeleteImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        UpdateImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all events', function () {
    $response = $this->connector->events()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Event',
                    'description' => 'Test Description',
                    'start_date' => '2023-01-01T10:00:00Z',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search events', function () {
    $response = $this->connector->events()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Event',
                    'description' => 'Test Description',
                    'start_date' => '2023-01-01T10:00:00Z',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get an event', function () {
    $response = $this->connector->events()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Test Event',
            'description' => 'Test Description',
            'start_date' => '2023-01-01T10:00:00Z',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create an event', function () {
    $response = $this->connector->events()->create([
        'title' => 'Test Event',
        'description' => 'Test Description',
        'start_date' => '2023-01-01T10:00:00Z',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Test Event',
            'description' => 'Test Description',
            'start_date' => '2023-01-01T10:00:00Z',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['title'] === 'Test Event'
            && $request->data['description'] === 'Test Description'
            && $request->data['start_date'] === '2023-01-01T10:00:00Z';
    });
});

test('it can update an event', function () {
    $response = $this->connector->events()->update(1, [
        'title' => 'Updated Event',
        'description' => 'Updated Description',
        'start_date' => '2023-01-02T10:00:00Z',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Updated Event',
            'description' => 'Updated Description',
            'start_date' => '2023-01-02T10:00:00Z',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['title'] === 'Updated Event'
            && $request->data['description'] === 'Updated Description'
            && $request->data['start_date'] === '2023-01-02T10:00:00Z';
    });
});

test('it can delete an event', function () {
    $response = $this->connector->events()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create events', function () {
    $response = $this->connector->events()->batchCreate(new ResourceObject(data: [
        'title' => 'Test Event',
        'description' => 'Test Description',
        'start_date' => '2023-01-01T10:00:00Z',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Event',
                    'description' => 'Test Description',
                    'start_date' => '2023-01-01T10:00:00Z',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'events';
    });
});

test('it can batch update events', function () {
    $response = $this->connector->events()->batchUpdate(new ResourceObject(1, [
        'title' => 'Updated Event',
        'description' => 'Updated Description',
        'start_date' => '2023-01-02T10:00:00Z',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Updated Event',
                    'description' => 'Updated Description',
                    'start_date' => '2023-01-02T10:00:00Z',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'events';
    });
});

test('it can batch delete events', function () {
    $response = $this->connector->events()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'events';
    });
});

test('it can get event images resource', function () {
    $resource = $this->connector->events()->images(1);

    expect($resource)->toBeInstanceOf(ImageResource::class);
});

test('it can get the event image', function () {
    $response = $this->connector->events()->imageGet(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetImageRequest;
    });
});

test('it can create the event image', function () {
    $response = $this->connector->events()->imageCreate(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateImageRequest;
    });
});

test('it can delete the event image', function () {
    $response = $this->connector->events()->imageDelete(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteImageRequest;
    });
});

test('it can update the event image', function () {
    $response = $this->connector->events()->imageUpdate(1, [
        'foo' => 'bar',
    ], [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateImageRequest;
    });
});
