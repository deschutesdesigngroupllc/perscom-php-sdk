<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Attach\AttachRequest;
use Perscom\Http\Requests\Attach\DetachRequest;
use Perscom\Http\Requests\Attach\SyncRequest;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\CreateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Crud\UpdateRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\Http\Resources\Users\CombatRecordsResource;
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
                    'enemy_casualties' => 10,
                    'friendly_casualties' => 2,
                    'mission_date' => '2024-01-15',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'enemy_casualties' => 10,
                    'friendly_casualties' => 2,
                    'mission_date' => '2024-01-15',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'enemy_casualties' => 10,
            'friendly_casualties' => 2,
            'mission_date' => '2024-01-15',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'enemy_casualties' => 10,
            'friendly_casualties' => 2,
            'mission_date' => '2024-01-15',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'enemy_casualties' => 15,
            'friendly_casualties' => 1,
            'mission_date' => '2024-01-16',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'enemy_casualties' => 10,
                    'friendly_casualties' => 2,
                    'mission_date' => '2024-01-15',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'enemy_casualties' => 15,
                    'friendly_casualties' => 1,
                    'mission_date' => '2024-01-16',
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
        AttachRequest::class => MockResponse::make([
            'attached' => [1],
        ]),
        DetachRequest::class => MockResponse::make([
            'detached' => [1],
        ]),
        SyncRequest::class => MockResponse::make([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);

    $this->resource = new CombatRecordsResource($this->connector, 'users/1/combat-records');
});

test('it can get all user combat records', function () {
    $response = $this->resource->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'enemy_casualties' => 10,
                    'friendly_casualties' => 2,
                    'mission_date' => '2024-01-15',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search user combat records', function () {
    $response = $this->resource->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'enemy_casualties' => 10,
                    'friendly_casualties' => 2,
                    'mission_date' => '2024-01-15',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a user combat record', function () {
    $response = $this->resource->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'enemy_casualties' => 10,
            'friendly_casualties' => 2,
            'mission_date' => '2024-01-15',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a user combat record', function () {
    $response = $this->resource->create([
        'enemy_casualties' => 10,
        'friendly_casualties' => 2,
        'mission_date' => '2024-01-15',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'enemy_casualties' => 10,
            'friendly_casualties' => 2,
            'mission_date' => '2024-01-15',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['enemy_casualties'] === 10
            && $request->data['friendly_casualties'] === 2;
    });
});

test('it can update a user combat record', function () {
    $response = $this->resource->update(1, [
        'enemy_casualties' => 15,
        'friendly_casualties' => 1,
        'mission_date' => '2024-01-16',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'enemy_casualties' => 15,
            'friendly_casualties' => 1,
            'mission_date' => '2024-01-16',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['enemy_casualties'] === 15;
    });
});

test('it can delete a user combat record', function () {
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

test('it can batch create user combat records', function () {
    $response = $this->resource->batchCreate(new ResourceObject(data: [
        'enemy_casualties' => 10,
        'friendly_casualties' => 2,
        'mission_date' => '2024-01-15',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'enemy_casualties' => 10,
                    'friendly_casualties' => 2,
                    'mission_date' => '2024-01-15',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'users/1/combat-records';
    });
});

test('it can batch update user combat records', function () {
    $response = $this->resource->batchUpdate(new ResourceObject(1, [
        'enemy_casualties' => 15,
        'friendly_casualties' => 1,
        'mission_date' => '2024-01-16',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'enemy_casualties' => 15,
                    'friendly_casualties' => 1,
                    'mission_date' => '2024-01-16',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'users/1/combat-records';
    });
});

test('it can batch delete user combat records', function () {
    $response = $this->resource->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'users/1/combat-records';
    });
});

test('it can attach a combat record to user', function () {
    $resource = new ResourceObject(1, ['enemy_casualties' => 10, 'friendly_casualties' => 2]);
    $response = $this->resource->attach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
        ]);

    $this->mockClient->assertSent(AttachRequest::class);
});

test('it can detach a combat record from user', function () {
    $resource = new ResourceObject(1);
    $response = $this->resource->detach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'detached' => [1],
        ]);

    $this->mockClient->assertSent(DetachRequest::class);
});

test('it can sync combat records for user', function () {
    $resource = new ResourceObject(1, ['enemy_casualties' => 10, 'friendly_casualties' => 2]);
    $response = $this->resource->sync($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]);

    $this->mockClient->assertSent(SyncRequest::class);
});
