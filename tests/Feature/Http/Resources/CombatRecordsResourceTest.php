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
                    'user_id' => 1,
                    'operation' => 'Test Operation',
                    'location' => 'Test Location',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'operation' => 'Test Operation',
                    'location' => 'Test Location',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'operation' => 'Test Operation',
            'location' => 'Test Location',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'operation' => 'Test Operation',
            'location' => 'Test Location',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'operation' => 'Updated Operation',
            'location' => 'Updated Location',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'operation' => 'Test Operation',
                    'location' => 'Test Location',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'operation' => 'Updated Operation',
                    'location' => 'Updated Location',
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

test('it can get all combat records', function () {
    $response = $this->connector->combatRecords()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'operation' => 'Test Operation',
                    'location' => 'Test Location',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search combat records', function () {
    $response = $this->connector->combatRecords()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'operation' => 'Test Operation',
                    'location' => 'Test Location',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a combat record', function () {
    $response = $this->connector->combatRecords()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'operation' => 'Test Operation',
            'location' => 'Test Location',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a combat record', function () {
    $response = $this->connector->combatRecords()->create([
        'user_id' => 1,
        'operation' => 'Test Operation',
        'location' => 'Test Location',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'operation' => 'Test Operation',
            'location' => 'Test Location',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['user_id'] === 1
            && $request->data['operation'] === 'Test Operation'
            && $request->data['location'] === 'Test Location';
    });
});

test('it can update a combat record', function () {
    $response = $this->connector->combatRecords()->update(1, [
        'operation' => 'Updated Operation',
        'location' => 'Updated Location',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'operation' => 'Updated Operation',
            'location' => 'Updated Location',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['operation'] === 'Updated Operation'
            && $request->data['location'] === 'Updated Location';
    });
});

test('it can delete a combat record', function () {
    $response = $this->connector->combatRecords()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create combat records', function () {
    $response = $this->connector->combatRecords()->batchCreate(new ResourceObject(data: [
        'user_id' => 1,
        'operation' => 'Test Operation',
        'location' => 'Test Location',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'operation' => 'Test Operation',
                    'location' => 'Test Location',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'combat-records';
    });
});

test('it can batch update combat records', function () {
    $response = $this->connector->combatRecords()->batchUpdate(new ResourceObject(1, [
        'operation' => 'Updated Operation',
        'location' => 'Updated Location',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'operation' => 'Updated Operation',
                    'location' => 'Updated Location',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'combat-records';
    });
});

test('it can batch delete combat records', function () {
    $response = $this->connector->combatRecords()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'combat-records';
    });
});
