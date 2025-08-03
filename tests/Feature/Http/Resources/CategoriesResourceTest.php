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
                    'name' => 'Test Category',
                    'type' => 'awards',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Category',
                    'type' => 'awards',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Test Category',
            'type' => 'awards',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Test Category',
            'type' => 'awards',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Updated Category',
            'type' => 'awards',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Category',
                    'type' => 'awards',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Updated Category',
                    'type' => 'awards',
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all categories', function () {
    $response = $this->connector->categories()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Category',
                    'type' => 'awards',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search categories', function () {
    $response = $this->connector->categories()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Category',
                    'type' => 'awards',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a category', function () {
    $response = $this->connector->categories()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Test Category',
            'type' => 'awards',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a category', function () {
    $response = $this->connector->categories()->create([
        'name' => 'Test Category',
        'type' => 'awards',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Test Category',
            'type' => 'awards',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['name'] === 'Test Category'
            && $request->data['type'] === 'awards';
    });
});

test('it can update a category', function () {
    $response = $this->connector->categories()->update(1, [
        'name' => 'Updated Category',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Updated Category',
            'type' => 'awards',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['name'] === 'Updated Category';
    });
});

test('it can delete a category', function () {
    $response = $this->connector->categories()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create categories', function () {
    $response = $this->connector->categories()->batchCreate(new ResourceObject(data: [
        'name' => 'Test Category',
        'type' => 'awards',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Category',
                    'type' => 'awards',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'categories';
    });
});

test('it can batch update categories', function () {
    $response = $this->connector->categories()->batchUpdate(new ResourceObject(1, [
        'name' => 'Updated Category',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Updated Category',
                    'type' => 'awards',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'categories';
    });
});

test('it can batch delete categories', function () {
    $response = $this->connector->categories()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'categories';
    });
});
