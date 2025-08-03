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
                    'title' => 'Test Task',
                    'description' => 'Task description',
                    'status' => 'pending',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Task',
                    'description' => 'Task description',
                    'status' => 'pending',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Test Task',
            'description' => 'Task description',
            'status' => 'pending',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Test Task',
            'description' => 'Task description',
            'status' => 'pending',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'status' => 'completed',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Task',
                    'description' => 'Task description',
                    'status' => 'pending',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Updated Task',
                    'description' => 'Updated description',
                    'status' => 'completed',
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

test('it can get all tasks', function () {
    $response = $this->connector->tasks()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Task',
                    'description' => 'Task description',
                    'status' => 'pending',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search tasks', function () {
    $response = $this->connector->tasks()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Task',
                    'description' => 'Task description',
                    'status' => 'pending',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a task', function () {
    $response = $this->connector->tasks()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Test Task',
            'description' => 'Task description',
            'status' => 'pending',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a task', function () {
    $response = $this->connector->tasks()->create([
        'title' => 'Test Task',
        'description' => 'Task description',
        'status' => 'pending',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Test Task',
            'description' => 'Task description',
            'status' => 'pending',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['title'] === 'Test Task';
    });
});

test('it can update a task', function () {
    $response = $this->connector->tasks()->update(1, [
        'title' => 'Updated Task',
        'description' => 'Updated description',
        'status' => 'completed',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'status' => 'completed',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['title'] === 'Updated Task';
    });
});

test('it can delete a task', function () {
    $response = $this->connector->tasks()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create tasks', function () {
    $response = $this->connector->tasks()->batchCreate(new ResourceObject(data: [
        'title' => 'Test Task',
        'description' => 'Task description',
        'status' => 'pending',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Task',
                    'description' => 'Task description',
                    'status' => 'pending',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'tasks';
    });
});

test('it can batch update tasks', function () {
    $response = $this->connector->tasks()->batchUpdate(new ResourceObject(1, [
        'title' => 'Updated Task',
        'description' => 'Updated description',
        'status' => 'completed',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Updated Task',
                    'description' => 'Updated description',
                    'status' => 'completed',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'tasks';
    });
});

test('it can batch delete tasks', function () {
    $response = $this->connector->tasks()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'tasks';
    });
});
