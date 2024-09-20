<?php

use Perscom\Http\Requests\Statuses\CreateStatusRequest;
use Perscom\Http\Requests\Statuses\DeleteStatusRequest;
use Perscom\Http\Requests\Statuses\GetStatusesRequest;
use Perscom\Http\Requests\Statuses\GetStatusRequest;
use Perscom\Http\Requests\Statuses\SearchStatusesRequest;
use Perscom\Http\Requests\Statuses\UpdateStatusRequest;
use Perscom\PerscomConnection;
use Saloon\Http\Request;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetStatusesRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        SearchStatusesRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ], 200),
        GetStatusRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateStatusRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateStatusRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteStatusRequest::class => MockResponse::make([], 201),
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
