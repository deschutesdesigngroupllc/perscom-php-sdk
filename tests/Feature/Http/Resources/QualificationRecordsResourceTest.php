<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\CreateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Crud\UpdateRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAllRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'qualification_id' => 456,
                    'date_earned' => '2023-01-01',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'qualification_id' => 456,
                    'date_earned' => '2023-01-01',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 123,
            'qualification_id' => 456,
            'date_earned' => '2023-01-01',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 123,
            'qualification_id' => 456,
            'date_earned' => '2023-01-01',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 123,
            'qualification_id' => 456,
            'date_earned' => '2023-01-02',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'qualification_id' => 456,
                    'date_earned' => '2023-01-01',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'qualification_id' => 456,
                    'date_earned' => '2023-01-02',
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all qualification records', function () {
    $response = $this->connector->qualificationRecords()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'qualification_id' => 456,
                    'date_earned' => '2023-01-01',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search qualification records', function () {
    $response = $this->connector->qualificationRecords()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'qualification_id' => 456,
                    'date_earned' => '2023-01-01',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a qualification record', function () {
    $response = $this->connector->qualificationRecords()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 123,
            'qualification_id' => 456,
            'date_earned' => '2023-01-01',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a qualification record', function () {
    $response = $this->connector->qualificationRecords()->create([
        'user_id' => 123,
        'qualification_id' => 456,
        'date_earned' => '2023-01-01',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 123,
            'qualification_id' => 456,
            'date_earned' => '2023-01-01',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['user_id'] === 123;
    });
});

test('it can update a qualification record', function () {
    $response = $this->connector->qualificationRecords()->update(1, [
        'user_id' => 123,
        'qualification_id' => 456,
        'date_earned' => '2023-01-02',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 123,
            'qualification_id' => 456,
            'date_earned' => '2023-01-02',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['date_earned'] === '2023-01-02';
    });
});

test('it can delete a qualification record', function () {
    $response = $this->connector->qualificationRecords()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create qualification records', function () {
    $response = $this->connector->qualificationRecords()->batchCreate(new ResourceObject(data: [
        'user_id' => 123,
        'qualification_id' => 456,
        'date_earned' => '2023-01-01',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'qualification_id' => 456,
                    'date_earned' => '2023-01-01',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'qualification-records';
    });
});

test('it can batch update qualification records', function () {
    $response = $this->connector->qualificationRecords()->batchUpdate(new ResourceObject(1, [
        'user_id' => 123,
        'qualification_id' => 456,
        'date_earned' => '2023-01-02',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'qualification_id' => 456,
                    'date_earned' => '2023-01-02',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'qualification-records';
    });
});

test('it can batch delete qualification records', function () {
    $response = $this->connector->qualificationRecords()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'qualification-records';
    });
});
