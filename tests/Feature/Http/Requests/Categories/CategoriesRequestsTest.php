<?php

use Perscom\Http\Requests\Categories\CreateCategoryRequest;
use Perscom\Http\Requests\Categories\DeleteCategoryRequest;
use Perscom\Http\Requests\Categories\GetCategoryRequest;
use Perscom\Http\Requests\Categories\GetCategoriesRequest;
use Perscom\Http\Requests\Categories\SearchCategoriesRequest;
use Perscom\Http\Requests\Categories\UpdateCategoryRequest;
use Perscom\PerscomConnection;
use Saloon\Http\Request;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetCategoriesRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        SearchCategoriesRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ], 200),
        GetCategoryRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateCategoryRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateCategoryRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteCategoryRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all categories', function () {
    $response = $this->connector->categories()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetCategoriesRequest::class);
});

test('it can search categories', function () {
    $response = $this->connector->categories()->search('foo');

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

    $this->mockClient->assertSent(SearchCategoriesRequest::class);
});

test('it can get a category', function () {
    $response = $this->connector->categories()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetCategoryRequest
            && $request->id === 1;
    });
});

test('it can create a category', function () {
    $response = $this->connector->categories()->create([
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
        return $request instanceof CreateCategoryRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a category', function () {
    $response = $this->connector->categories()->update(1, [
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
        return $request instanceof UpdateCategoryRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a category', function () {
    $response = $this->connector->categories()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteCategoryRequest
            && $request->id === 1;
    });
});
