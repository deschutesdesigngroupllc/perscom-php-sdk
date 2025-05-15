<?php

declare(strict_types=1);

use Perscom\Http\Requests\Users\TrainingRecords\CreateUserTrainingRecordRequest;
use Perscom\Http\Requests\Users\TrainingRecords\DeleteUserTrainingRecordRequest;
use Perscom\Http\Requests\Users\TrainingRecords\GetUserTrainingRecordRequest;
use Perscom\Http\Requests\Users\TrainingRecords\GetUserTrainingRecordsRequest;
use Perscom\Http\Requests\Users\TrainingRecords\UpdateUserTrainingRecordRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUserTrainingRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        GetUserTrainingRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateUserTrainingRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateUserTrainingRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteUserTrainingRecordRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users training records', function () {
    $response = $this->connector->users()->training_records(1)->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUserTrainingRecordsRequest::class);
});

test('it can get a users training record', function () {
    $response = $this->connector->users()->training_records(1)->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserTrainingRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});

test('it can create a users training record', function () {
    $response = $this->connector->users()->training_records(1)->create([
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
        return $request instanceof CreateUserTrainingRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a users training record', function () {
    $response = $this->connector->users()->training_records(1)->update(1, [
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
        return $request instanceof UpdateUserTrainingRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a users training record', function () {
    $response = $this->connector->users()->training_records(1)->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUserTrainingRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});
