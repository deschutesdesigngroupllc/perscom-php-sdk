<?php

declare(strict_types=1);

use Perscom\Http\Requests\Users\QualificationRecords\CreateUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\DeleteUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\GetUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\GetUserQualificationRecordsRequest;
use Perscom\Http\Requests\Users\QualificationRecords\UpdateUserQualificationRecordRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUserQualificationRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        GetUserQualificationRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateUserQualificationRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateUserQualificationRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteUserQualificationRecordRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users qualification records', function () {
    $response = $this->connector->users()->qualification_records(1)->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUserQualificationRecordsRequest::class);
});

test('it can get a users qualification record', function () {
    $response = $this->connector->users()->qualification_records(1)->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserQualificationRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});

test('it can create a users qualification record', function () {
    $response = $this->connector->users()->qualification_records(1)->create([
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
        return $request instanceof CreateUserQualificationRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a users qualification record', function () {
    $response = $this->connector->users()->qualification_records(1)->update(1, [
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
        return $request instanceof UpdateUserQualificationRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a users qualification record', function () {
    $response = $this->connector->users()->qualification_records(1)->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUserQualificationRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});
