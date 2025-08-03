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
                    'name' => 'Test Unit',
                    'description' => 'Unit description',
                    'type' => 'squadron',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Unit',
                    'description' => 'Unit description',
                    'type' => 'squadron',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Test Unit',
            'description' => 'Unit description',
            'type' => 'squadron',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Test Unit',
            'description' => 'Unit description',
            'type' => 'squadron',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Updated Unit',
            'description' => 'Updated description',
            'type' => 'wing',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Unit',
                    'description' => 'Unit description',
                    'type' => 'squadron',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Updated Unit',
                    'description' => 'Updated description',
                    'type' => 'wing',
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

test('it can get all units', function () {
    $response = $this->connector->units()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Unit',
                    'description' => 'Unit description',
                    'type' => 'squadron',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search units', function () {
    $response = $this->connector->units()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Unit',
                    'description' => 'Unit description',
                    'type' => 'squadron',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a unit', function () {
    $response = $this->connector->units()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Test Unit',
            'description' => 'Unit description',
            'type' => 'squadron',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a unit', function () {
    $response = $this->connector->units()->create([
        'name' => 'Test Unit',
        'description' => 'Unit description',
        'type' => 'squadron',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Test Unit',
            'description' => 'Unit description',
            'type' => 'squadron',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['name'] === 'Test Unit';
    });
});

test('it can update a unit', function () {
    $response = $this->connector->units()->update(1, [
        'name' => 'Updated Unit',
        'description' => 'Updated description',
        'type' => 'wing',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Updated Unit',
            'description' => 'Updated description',
            'type' => 'wing',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['name'] === 'Updated Unit';
    });
});

test('it can delete a unit', function () {
    $response = $this->connector->units()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create units', function () {
    $response = $this->connector->units()->batchCreate(new ResourceObject(data: [
        'name' => 'Test Unit',
        'description' => 'Unit description',
        'type' => 'squadron',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Unit',
                    'description' => 'Unit description',
                    'type' => 'squadron',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'units';
    });
});

test('it can batch update units', function () {
    $response = $this->connector->units()->batchUpdate(new ResourceObject(1, [
        'name' => 'Updated Unit',
        'description' => 'Updated description',
        'type' => 'wing',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Updated Unit',
                    'description' => 'Updated description',
                    'type' => 'wing',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'units';
    });
});

test('it can batch delete units', function () {
    $response = $this->connector->units()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'units';
    });
});
