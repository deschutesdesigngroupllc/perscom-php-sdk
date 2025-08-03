<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Attach\AttachRequest;
use Perscom\Http\Requests\Attach\DetachRequest;
use Perscom\Http\Requests\Attach\SyncRequest;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\CreateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Crud\UpdateRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\Http\Resources\Users\TrainingRecordsResource;
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
                    'user_id' => 1,
                    'course_name' => 'Basic Training',
                    'completed_at' => '2024-01-15',
                    'instructor' => 'John Smith',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'course_name' => 'Basic Training',
                    'completed_at' => '2024-01-15',
                    'instructor' => 'John Smith',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'course_name' => 'Basic Training',
            'completed_at' => '2024-01-15',
            'instructor' => 'John Smith',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'course_name' => 'Basic Training',
            'completed_at' => '2024-01-15',
            'instructor' => 'John Smith',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'user_id' => 1,
            'course_name' => 'Advanced Training',
            'completed_at' => '2024-01-16',
            'instructor' => 'Jane Doe',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'course_name' => 'Basic Training',
                    'completed_at' => '2024-01-15',
                    'instructor' => 'John Smith',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'course_name' => 'Advanced Training',
                    'completed_at' => '2024-01-16',
                    'instructor' => 'Jane Doe',
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
        AttachRequest::class => MockResponse::make([
            'attached' => [1],
        ]),
        DetachRequest::class => MockResponse::make([
            'detached' => [1],
        ]),
        SyncRequest::class => MockResponse::make([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);

    $this->resource = new TrainingRecordsResource($this->connector, 'users/1/training-records');
});

test('it can get all user training records', function () {
    $response = $this->resource->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'course_name' => 'Basic Training',
                    'completed_at' => '2024-01-15',
                    'instructor' => 'John Smith',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search user training records', function () {
    $response = $this->resource->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'course_name' => 'Basic Training',
                    'completed_at' => '2024-01-15',
                    'instructor' => 'John Smith',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a user training record', function () {
    $response = $this->resource->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'course_name' => 'Basic Training',
            'completed_at' => '2024-01-15',
            'instructor' => 'John Smith',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a user training record', function () {
    $response = $this->resource->create([
        'course_name' => 'Basic Training',
        'completed_at' => '2024-01-15',
        'instructor' => 'John Smith',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'course_name' => 'Basic Training',
            'completed_at' => '2024-01-15',
            'instructor' => 'John Smith',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['course_name'] === 'Basic Training'
            && $request->data['instructor'] === 'John Smith';
    });
});

test('it can update a user training record', function () {
    $response = $this->resource->update(1, [
        'course_name' => 'Advanced Training',
        'completed_at' => '2024-01-16',
        'instructor' => 'Jane Doe',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'user_id' => 1,
            'course_name' => 'Advanced Training',
            'completed_at' => '2024-01-16',
            'instructor' => 'Jane Doe',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['course_name'] === 'Advanced Training';
    });
});

test('it can delete a user training record', function () {
    $response = $this->resource->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create user training records', function () {
    $response = $this->resource->batchCreate(new ResourceObject(data: [
        'course_name' => 'Basic Training',
        'completed_at' => '2024-01-15',
        'instructor' => 'John Smith',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'course_name' => 'Basic Training',
                    'completed_at' => '2024-01-15',
                    'instructor' => 'John Smith',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'users/1/training-records';
    });
});

test('it can batch update user training records', function () {
    $response = $this->resource->batchUpdate(new ResourceObject(1, [
        'course_name' => 'Advanced Training',
        'completed_at' => '2024-01-16',
        'instructor' => 'Jane Doe',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'course_name' => 'Advanced Training',
                    'completed_at' => '2024-01-16',
                    'instructor' => 'Jane Doe',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'users/1/training-records';
    });
});

test('it can batch delete user training records', function () {
    $response = $this->resource->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'users/1/training-records';
    });
});

test('it can attach a training record to user', function () {
    $resource = new ResourceObject(1, ['course_name' => 'Basic Training', 'instructor' => 'John Smith']);
    $response = $this->resource->attach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
        ]);

    $this->mockClient->assertSent(AttachRequest::class);
});

test('it can detach a training record from user', function () {
    $resource = new ResourceObject(1);
    $response = $this->resource->detach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'detached' => [1],
        ]);

    $this->mockClient->assertSent(DetachRequest::class);
});

test('it can sync training records for user', function () {
    $resource = new ResourceObject(1, ['course_name' => 'Basic Training', 'instructor' => 'John Smith']);
    $response = $this->resource->sync($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]);

    $this->mockClient->assertSent(SyncRequest::class);
});
