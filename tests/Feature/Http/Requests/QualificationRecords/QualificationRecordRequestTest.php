<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\QualificationRecords\BatchCreateQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\BatchDeleteQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\BatchUpdateQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\CreateQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\DeleteQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\GetQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\GetQualificationRecordsRequest;
use Perscom\Http\Requests\QualificationRecords\UpdateQualificationRecordRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetQualificationRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        GetQualificationRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateQualificationRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateQualificationRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteQualificationRecordRequest::class => MockResponse::make([], 201),
        BatchCreateQualificationRecordRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchUpdateQualificationRecordRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchDeleteQualificationRecordRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
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
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetQualificationRecordsRequest::class);
});

test('it can get a qualification record', function () {
    $response = $this->connector->qualificationRecords()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetQualificationRecordRequest
            && $request->id === 1;
    });
});

test('it can create a qualification record', function () {
    $response = $this->connector->qualificationRecords()->create([
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
        return $request instanceof CreateQualificationRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a qualification record', function () {
    $response = $this->connector->qualificationRecords()->update(1, [
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
        return $request instanceof UpdateQualificationRecordRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a qualification record', function () {
    $response = $this->connector->qualificationRecords()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteQualificationRecordRequest
            && $request->id === 1;
    });
});

test('it can batch create qualification records', function () {
    $response = $this->connector->qualificationRecords()->batchCreate(new ResourceObject(data: [
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
        return $request instanceof BatchCreateQualificationRecordRequest;
    });
});

test('it can batch update qualification records', function () {
    $response = $this->connector->qualificationRecords()->batchUpdate(new ResourceObject(1, [
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
        return $request instanceof BatchUpdateQualificationRecordRequest;
    });
});

test('it can batch delete qualification records', function () {
    $response = $this->connector->qualificationRecords()->batchDelete(new ResourceObject(1));

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
        return $request instanceof BatchDeleteQualificationRecordRequest;
    });
});
