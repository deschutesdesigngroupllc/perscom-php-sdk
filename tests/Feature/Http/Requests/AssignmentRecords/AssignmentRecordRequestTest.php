<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\AssignmentRecords\CreateAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\DeleteAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\GetAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\GetAssignmentRecordsRequest;
use Perscom\Http\Requests\AssignmentRecords\UpdateAssignmentRecordRequest;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAssignmentRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        GetAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteAssignmentRecordRequest::class => MockResponse::make([], 201),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all assignment records', function () {
    $response = $this->connector->assignmentRecords()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetAssignmentRecordsRequest::class);
});

test('it can get an assignment record', function () {
    $response = $this->connector->assignmentRecords()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetAssignmentRecordRequest
            && $request->id === 1;
    });
});

test('it can create an assignment record', function () {
    $response = $this->connector->assignmentRecords()->create([
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
        return $request instanceof CreateAssignmentRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update an assignment record', function () {
    $response = $this->connector->assignmentRecords()->update(1, [
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
        return $request instanceof UpdateAssignmentRecordRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete an assignment record', function () {
    $response = $this->connector->assignmentRecords()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteAssignmentRecordRequest
            && $request->id === 1;
    });
});

test('it can batch create assignment records', function () {
    $response = $this->connector->assignmentRecords()->batchCreate(new ResourceObject(data: [
        'foo' => 'bar',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'assignment-records';
    });
});

test('it can batch update assignment records', function () {
    $response = $this->connector->assignmentRecords()->batchUpdate(new ResourceObject(1, [
        'foo' => 'bar',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'assignment-records';
    });
});

test('it can batch delete assignment records', function () {
    $response = $this->connector->assignmentRecords()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'assignment-records';
    });
});
