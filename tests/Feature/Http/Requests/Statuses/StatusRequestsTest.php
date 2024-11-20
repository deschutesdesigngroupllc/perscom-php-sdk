<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Statuses\BatchCreateStatusRequest;
use Perscom\Http\Requests\Statuses\BatchDeleteStatusRequest;
use Perscom\Http\Requests\Statuses\BatchUpdateStatusRequest;
use Perscom\Http\Requests\Statuses\CreateStatusRequest;
use Perscom\Http\Requests\Statuses\DeleteStatusRequest;
use Perscom\Http\Requests\Statuses\GetStatusesRequest;
use Perscom\Http\Requests\Statuses\GetStatusRequest;
use Perscom\Http\Requests\Statuses\SearchStatusesRequest;
use Perscom\Http\Requests\Statuses\UpdateStatusRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetStatusesRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchStatusesRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetStatusRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateStatusRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateStatusRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteStatusRequest::class => MockResponse::make([], 201),
        BatchCreateStatusRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchUpdateStatusRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchDeleteStatusRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all statuses', function () {
    $response = $this->connector->statuses()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetStatusesRequest::class);
});

test('it can search statuses', function () {
    $response = $this->connector->statuses()->search('foo');

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

    $this->mockClient->assertSent(SearchStatusesRequest::class);
});

test('it can get a status', function () {
    $response = $this->connector->statuses()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetStatusRequest
            && $request->id === 1;
    });
});

test('it can create a status', function () {
    $response = $this->connector->statuses()->create([
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
        return $request instanceof CreateStatusRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a status', function () {
    $response = $this->connector->statuses()->update(1, [
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
        return $request instanceof UpdateStatusRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a status', function () {
    $response = $this->connector->statuses()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteStatusRequest
            && $request->id === 1;
    });
});

test('it can batch create statuses', function () {
    $response = $this->connector->statuses()->batchCreate(new ResourceObject(data: [
        'foo' => 'bar',
    ]));

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
        return $request instanceof BatchCreateStatusRequest;
    });
});

test('it can batch update statuses', function () {
    $response = $this->connector->statuses()->batchUpdate(new ResourceObject(1, [
        'foo' => 'bar',
    ]));

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
        return $request instanceof BatchUpdateStatusRequest;
    });
});

test('it can batch delete statuses', function () {
    $response = $this->connector->statuses()->batchDelete(new ResourceObject(1));

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
        return $request instanceof BatchDeleteStatusRequest;
    });
});
