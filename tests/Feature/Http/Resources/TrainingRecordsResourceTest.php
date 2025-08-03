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
                    'course_name' => 'Basic Training',
                    'completion_date' => '2023-01-01',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'course_name' => 'Basic Training',
                    'completion_date' => '2023-01-01',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 123,
            'course_name' => 'Basic Training',
            'completion_date' => '2023-01-01',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 123,
            'course_name' => 'Basic Training',
            'completion_date' => '2023-01-01',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 123,
            'course_name' => 'Advanced Training',
            'completion_date' => '2023-02-01',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'course_name' => 'Basic Training',
                    'completion_date' => '2023-01-01',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'course_name' => 'Advanced Training',
                    'completion_date' => '2023-02-01',
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

test('it can get all training records', function () {
    $response = $this->connector->trainingRecords()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'course_name' => 'Basic Training',
                    'completion_date' => '2023-01-01',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search training records', function () {
    $response = $this->connector->trainingRecords()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'course_name' => 'Basic Training',
                    'completion_date' => '2023-01-01',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a training record', function () {
    $response = $this->connector->trainingRecords()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 123,
            'course_name' => 'Basic Training',
            'completion_date' => '2023-01-01',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a training record', function () {
    $response = $this->connector->trainingRecords()->create([
        'user_id' => 123,
        'course_name' => 'Basic Training',
        'completion_date' => '2023-01-01',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 123,
            'course_name' => 'Basic Training',
            'completion_date' => '2023-01-01',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['user_id'] === 123;
    });
});

test('it can update a training record', function () {
    $response = $this->connector->trainingRecords()->update(1, [
        'user_id' => 123,
        'course_name' => 'Advanced Training',
        'completion_date' => '2023-02-01',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 123,
            'course_name' => 'Advanced Training',
            'completion_date' => '2023-02-01',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['course_name'] === 'Advanced Training';
    });
});

test('it can delete a training record', function () {
    $response = $this->connector->trainingRecords()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create training records', function () {
    $response = $this->connector->trainingRecords()->batchCreate(new ResourceObject(data: [
        'user_id' => 123,
        'course_name' => 'Basic Training',
        'completion_date' => '2023-01-01',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'course_name' => 'Basic Training',
                    'completion_date' => '2023-01-01',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'training-records';
    });
});

test('it can batch update training records', function () {
    $response = $this->connector->trainingRecords()->batchUpdate(new ResourceObject(1, [
        'user_id' => 123,
        'course_name' => 'Advanced Training',
        'completion_date' => '2023-02-01',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 123,
                    'course_name' => 'Advanced Training',
                    'completion_date' => '2023-02-01',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'training-records';
    });
});

test('it can batch delete training records', function () {
    $response = $this->connector->trainingRecords()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'training-records';
    });
});
