<?php

declare(strict_types=1);

use Perscom\Http\Requests\Awards\CreateAwardRequest;
use Perscom\Http\Requests\Awards\DeleteAwardRequest;
use Perscom\Http\Requests\Awards\GetAwardRequest;
use Perscom\Http\Requests\Awards\GetAwardsRequest;
use Perscom\Http\Requests\Awards\SearchAwardsRequest;
use Perscom\Http\Requests\Awards\UpdateAwardRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAwardsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchAwardsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetAwardRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateAwardRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateAwardRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteAwardRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all awards', function () {
    $response = $this->connector->awards()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetAwardsRequest::class);
});

test('it can search awards', function () {
    $response = $this->connector->awards()->search('foo');

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

    $this->mockClient->assertSent(SearchAwardsRequest::class);
});

test('it can get an award', function () {
    $response = $this->connector->awards()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetAwardRequest
            && $request->id === 1;
    });
});

test('it can create an award', function () {
    $response = $this->connector->awards()->create([
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
        return $request instanceof CreateAwardRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update an award', function () {
    $response = $this->connector->awards()->update(1, [
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
        return $request instanceof UpdateAwardRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete an award', function () {
    $response = $this->connector->awards()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteAwardRequest
            && $request->id === 1;
    });
});
