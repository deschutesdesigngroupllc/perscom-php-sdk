<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\AwardRecords\CreateAwardRecordRequest;
use Perscom\Http\Requests\AwardRecords\DeleteAwardRecordRequest;
use Perscom\Http\Requests\AwardRecords\GetAwardRecordRequest;
use Perscom\Http\Requests\AwardRecords\GetAwardRecordsRequest;
use Perscom\Http\Requests\AwardRecords\UpdateAwardRecordRequest;
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
        GetAwardRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        GetAwardRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateAwardRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateAwardRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteAwardRecordRequest::class => MockResponse::make([], 201),
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

test('it can get all award records', function () {
    $response = $this->connector->awardRecords()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetAwardRecordsRequest::class);
});

test('it can get an award record', function () {
    $response = $this->connector->awardRecords()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetAwardRecordRequest
            && $request->id === 1;
    });
});

test('it can create an award record', function () {
    $response = $this->connector->awardRecords()->create([
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
        return $request instanceof CreateAwardRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update an award record', function () {
    $response = $this->connector->awardRecords()->update(1, [
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
        return $request instanceof UpdateAwardRecordRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete an award record', function () {
    $response = $this->connector->awardRecords()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteAwardRecordRequest
            && $request->id === 1;
    });
});

test('it can batch create award records', function () {
    $response = $this->connector->awardRecords()->batchCreate(new ResourceObject(data: [
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
            && $request->resource === 'award-records';
    });
});

test('it can batch update award records', function () {
    $response = $this->connector->awardRecords()->batchUpdate(new ResourceObject(1, [
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
            && $request->resource === 'award-records';
    });
});

test('it can batch delete award records', function () {
    $response = $this->connector->awardRecords()->batchDelete(new ResourceObject(1));

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
            && $request->resource === 'award-records';
    });
});
