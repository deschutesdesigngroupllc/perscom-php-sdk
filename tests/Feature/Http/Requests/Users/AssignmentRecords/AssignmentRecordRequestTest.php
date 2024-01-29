<?php

use Perscom\Http\Requests\Users\AssignmentRecords\CreateUserAssignmentRecordRequest;
use Perscom\Http\Requests\Users\AssignmentRecords\DeleteUserAssignmentRecordRequest;
use Perscom\Http\Requests\Users\AssignmentRecords\GetUserAssignmentRecordRequest;
use Perscom\Http\Requests\Users\AssignmentRecords\GetUserAssignmentRecordsRequest;
use Perscom\Http\Requests\Users\AssignmentRecords\UpdateUserAssignmentRecordRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\Request;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUserAssignmentRecordsRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
        GetUserAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        CreateUserAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        UpdateUserAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        DeleteUserAssignmentRecordRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users assignment records', function () {
    $response = $this->connector->users()->assignment_records(1)->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUserAssignmentRecordsRequest::class);
});

test('it can get a users assignment record', function () {
    $response = $this->connector->users()->assignment_records(1)->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserAssignmentRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});

test('it can create a users assignment record', function () {
    $response = $this->connector->users()->assignment_records(1)->create([
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
        return $request instanceof CreateUserAssignmentRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a users assignment record', function () {
    $response = $this->connector->users()->assignment_records(1)->update(1, [
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
        return $request instanceof UpdateUserAssignmentRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a users assignment record', function () {
    $response = $this->connector->users()->assignment_records(1)->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUserAssignmentRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});
