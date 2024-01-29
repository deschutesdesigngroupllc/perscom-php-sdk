<?php

use Perscom\Http\Requests\Positions\CreatePositionRequest;
use Perscom\Http\Requests\Positions\DeletePositionRequest;
use Perscom\Http\Requests\Positions\GetPositionRequest;
use Perscom\Http\Requests\Positions\GetPositionsRequest;
use Perscom\Http\Requests\Positions\SearchPositionsRequest;
use Perscom\Http\Requests\Positions\UpdatePositionRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\Request;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetPositionsRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
        SearchPositionsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo'
                ]
            ]
        ], 200),
        GetPositionRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        CreatePositionRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        UpdatePositionRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        DeletePositionRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all positions', function () {
    $response = $this->connector->positions()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetPositionsRequest::class);
});

test('it can search positions', function () {
    $response = $this->connector->positions()->search([
        'filters' => [
            ['field' => 'name', 'value' => 'foo']
        ]
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo'
                ]
            ]
        ]);

    $this->mockClient->assertSent(SearchPositionsRequest::class);
});

test('it can get a position', function () {
    $response = $this->connector->positions()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetPositionRequest
            && $request->id === 1;
    });
});

test('it can create a position', function () {
    $response = $this->connector->positions()->create([
        'foo' => 'bar'
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreatePositionRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a position', function () {
    $response = $this->connector->positions()->update(1, [
        'foo' => 'bar'
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdatePositionRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a position', function () {
    $response = $this->connector->positions()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeletePositionRequest
            && $request->id === 1;
    });
});
