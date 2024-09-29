<?php

declare(strict_types=1);

use Perscom\Http\Requests\Tasks\CreateTaskRequest;
use Perscom\Http\Requests\Tasks\DeleteTaskRequest;
use Perscom\Http\Requests\Tasks\GetTaskRequest;
use Perscom\Http\Requests\Tasks\GetTasksRequest;
use Perscom\Http\Requests\Tasks\SearchTasksRequest;
use Perscom\Http\Requests\Tasks\UpdateTaskRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetTasksRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchTasksRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetTaskRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateTaskRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateTaskRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteTaskRequest::class => MockResponse::make([], 201),
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
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetTasksRequest::class);
});

test('it can search tasks', function () {
    $response = $this->connector->tasks()->search('foo');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchTasksRequest::class);
});

test('it can get a task', function () {
    $response = $this->connector->tasks()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetTaskRequest
            && $request->id === 1;
    });
});

test('it can create a task', function () {
    $response = $this->connector->tasks()->create([
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateTaskRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a task', function () {
    $response = $this->connector->tasks()->update(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateTaskRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a task', function () {
    $response = $this->connector->tasks()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteTaskRequest
            && $request->id === 1;
    });
});
