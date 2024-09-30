<?php

declare(strict_types=1);

use Perscom\Http\Requests\Specialties\CreateSpecialtyRequest;
use Perscom\Http\Requests\Specialties\DeleteSpecialtyRequest;
use Perscom\Http\Requests\Specialties\GetSpecialtiesRequest;
use Perscom\Http\Requests\Specialties\GetSpecialtyRequest;
use Perscom\Http\Requests\Specialties\SearchSpecialtiesRequest;
use Perscom\Http\Requests\Specialties\UpdateSpecialtyRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetSpecialtiesRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchSpecialtiesRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetSpecialtyRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateSpecialtyRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateSpecialtyRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteSpecialtyRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all specialties', function () {
    $response = $this->connector->specialties()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetSpecialtiesRequest::class);
});

test('it can search specialties', function () {
    $response = $this->connector->specialties()->search('foo');

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

    $this->mockClient->assertSent(SearchSpecialtiesRequest::class);
});

test('it can get a specialty', function () {
    $response = $this->connector->specialties()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetSpecialtyRequest
            && $request->id === 1;
    });
});

test('it can create a specialty', function () {
    $response = $this->connector->specialties()->create([
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
        return $request instanceof CreateSpecialtyRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a specialty', function () {
    $response = $this->connector->specialties()->update(1, [
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
        return $request instanceof UpdateSpecialtyRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a specialty', function () {
    $response = $this->connector->specialties()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteSpecialtyRequest
            && $request->id === 1;
    });
});
