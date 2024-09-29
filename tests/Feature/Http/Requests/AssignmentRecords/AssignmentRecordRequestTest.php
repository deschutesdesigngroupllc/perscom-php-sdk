<?php

declare(strict_types=1);

use Perscom\Http\Requests\AssignmentRecords\CreateAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\DeleteAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\GetAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\GetAssignmentRecordsRequest;
use Perscom\Http\Requests\AssignmentRecords\UpdateAssignmentRecordRequest;
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
        ], 200),
        GetAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateAssignmentRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteAssignmentRecordRequest::class => MockResponse::make([], 201),
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
