<?php

declare(strict_types=1);

use Perscom\Http\Requests\Units\CreateUnitRequest;
use Perscom\Http\Requests\Units\DeleteUnitRequest;
use Perscom\Http\Requests\Units\GetUnitRequest;
use Perscom\Http\Requests\Units\GetUnitsRequest;
use Perscom\Http\Requests\Units\SearchUnitsRequest;
use Perscom\Http\Requests\Units\UpdateUnitRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUnitsRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        SearchUnitsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ], 200),
        GetUnitRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateUnitRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateUnitRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteUnitRequest::class => MockResponse::make([], 201),
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
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUnitsRequest::class);
});

test('it can search units', function () {
    $response = $this->connector->units()->search('foo');

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

    $this->mockClient->assertSent(SearchUnitsRequest::class);
});

test('it can get a unit', function () {
    $response = $this->connector->units()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUnitRequest
            && $request->id === 1;
    });
});

test('it can create a unit', function () {
    $response = $this->connector->units()->create([
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
        return $request instanceof CreateUnitRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a unit', function () {
    $response = $this->connector->units()->update(1, [
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
        return $request instanceof UpdateUnitRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a unit', function () {
    $response = $this->connector->units()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUnitRequest
            && $request->id === 1;
    });
});
