<?php

declare(strict_types=1);

use Perscom\Http\Requests\Users\RankRecords\CreateUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\DeleteUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\GetUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\GetUserRankRecordsRequest;
use Perscom\Http\Requests\Users\RankRecords\UpdateUserRankRecordRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUserRankRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        GetUserRankRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateUserRankRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateUserRankRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteUserRankRecordRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users rank records', function () {
    $response = $this->connector->users()->rank_records(1)->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUserRankRecordsRequest::class);
});

test('it can get a users rank record', function () {
    $response = $this->connector->users()->rank_records(1)->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserRankRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});

test('it can create a users rank record', function () {
    $response = $this->connector->users()->rank_records(1)->create([
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
        return $request instanceof CreateUserRankRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a users rank record', function () {
    $response = $this->connector->users()->rank_records(1)->update(1, [
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
        return $request instanceof UpdateUserRankRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a users rank record', function () {
    $response = $this->connector->users()->rank_records(1)->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUserRankRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});
