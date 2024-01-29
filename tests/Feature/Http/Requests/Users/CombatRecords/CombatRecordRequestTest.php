<?php

use Perscom\Http\Requests\Users\CombatRecords\CreateUserCombatRecordRequest;
use Perscom\Http\Requests\Users\CombatRecords\DeleteUserCombatRecordRequest;
use Perscom\Http\Requests\Users\CombatRecords\GetUserCombatRecordRequest;
use Perscom\Http\Requests\Users\CombatRecords\GetUserCombatRecordsRequest;
use Perscom\Http\Requests\Users\CombatRecords\UpdateUserCombatRecordRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\Request;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUserCombatRecordsRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
        GetUserCombatRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        CreateUserCombatRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        UpdateUserCombatRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        DeleteUserCombatRecordRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users combat records', function () {
    $response = $this->connector->users()->combat_records(1)->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUserCombatRecordsRequest::class);
});

test('it can get a users combat record', function () {
    $response = $this->connector->users()->combat_records(1)->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserCombatRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});

test('it can create a users combat record', function () {
    $response = $this->connector->users()->combat_records(1)->create([
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
        return $request instanceof CreateUserCombatRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a users combat record', function () {
    $response = $this->connector->users()->combat_records(1)->update(1, [
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
        return $request instanceof UpdateUserCombatRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a users combat record', function () {
    $response = $this->connector->users()->combat_records(1)->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUserCombatRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});
