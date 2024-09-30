<?php

declare(strict_types=1);

use Perscom\Http\Requests\Users\AwardRecords\CreateUserAwardRecordRequest;
use Perscom\Http\Requests\Users\AwardRecords\DeleteUserAwardRecordRequest;
use Perscom\Http\Requests\Users\AwardRecords\GetUserAwardRecordRequest;
use Perscom\Http\Requests\Users\AwardRecords\GetUserAwardRecordsRequest;
use Perscom\Http\Requests\Users\AwardRecords\UpdateUserAwardRecordRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUserAwardRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        GetUserAwardRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateUserAwardRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateUserAwardRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteUserAwardRecordRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users award records', function () {
    $response = $this->connector->users()->award_records(1)->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUserAwardRecordsRequest::class);
});

test('it can get a users award record', function () {
    $response = $this->connector->users()->award_records(1)->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserAwardRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});

test('it can create a users award record', function () {
    $response = $this->connector->users()->award_records(1)->create([
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
        return $request instanceof CreateUserAwardRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a users award record', function () {
    $response = $this->connector->users()->award_records(1)->update(1, [
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
        return $request instanceof UpdateUserAwardRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a users award record', function () {
    $response = $this->connector->users()->award_records(1)->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUserAwardRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});
