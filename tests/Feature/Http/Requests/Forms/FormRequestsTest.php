<?php

use Perscom\Http\Requests\Forms\CreateFormRequest;
use Perscom\Http\Requests\Forms\DeleteFormRequest;
use Perscom\Http\Requests\Forms\GetFormRequest;
use Perscom\Http\Requests\Forms\GetFormsRequest;
use Perscom\Http\Requests\Forms\SearchFormsRequest;
use Perscom\Http\Requests\Forms\UpdateFormRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\Request;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetFormsRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
        SearchFormsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo'
                ]
            ]
        ], 200),
        GetFormRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        CreateFormRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        UpdateFormRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        DeleteFormRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all forms', function () {
    $response = $this->connector->forms()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetFormsRequest::class);
});

test('it can search forms', function () {
    $response = $this->connector->forms()->search('foo');

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

    $this->mockClient->assertSent(SearchFormsRequest::class);
});

test('it can get a form', function () {
    $response = $this->connector->forms()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetFormRequest
            && $request->id === 1;
    });
});

test('it can create a form', function () {
    $response = $this->connector->forms()->create([
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
        return $request instanceof CreateFormRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a form', function () {
    $response = $this->connector->forms()->update(1, [
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
        return $request instanceof UpdateFormRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a form', function () {
    $response = $this->connector->forms()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteFormRequest
            && $request->id === 1;
    });
});
