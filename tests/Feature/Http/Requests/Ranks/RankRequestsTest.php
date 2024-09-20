<?php

use Perscom\Http\Requests\Ranks\CreateRankRequest;
use Perscom\Http\Requests\Ranks\DeleteRankRequest;
use Perscom\Http\Requests\Ranks\GetRankRequest;
use Perscom\Http\Requests\Ranks\GetRanksRequest;
use Perscom\Http\Requests\Ranks\SearchRanksRequest;
use Perscom\Http\Requests\Ranks\UpdateRankRequest;
use Perscom\PerscomConnection;
use Saloon\Http\Request;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetRanksRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        SearchRanksRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ], 200),
        GetRankRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateRankRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateRankRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteRankRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all ranks', function () {
    $response = $this->connector->ranks()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetRanksRequest::class);
});

test('it can search ranks', function () {
    $response = $this->connector->ranks()->search('foo');

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

    $this->mockClient->assertSent(SearchRanksRequest::class);
});

test('it can get a rank', function () {
    $response = $this->connector->ranks()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRankRequest
            && $request->id === 1;
    });
});

test('it can create a rank', function () {
    $response = $this->connector->ranks()->create([
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
        return $request instanceof CreateRankRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a rank', function () {
    $response = $this->connector->ranks()->update(1, [
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
        return $request instanceof UpdateRankRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a rank', function () {
    $response = $this->connector->ranks()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRankRequest
            && $request->id === 1;
    });
});
