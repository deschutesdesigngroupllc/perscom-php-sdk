<?php

use Perscom\Exceptions\AuthenticationException;
use Perscom\Exceptions\NotFoundHttpException;
use Perscom\Exceptions\TenantCouldNotBeIdentifiedException;
use Perscom\Http\Requests\Users\AssignmentRecords\GetUserAssignmentRecordRequest;
use Perscom\Http\Requests\Users\AssignmentRecords\GetUserAssignmentRecordsRequest;
use Perscom\Http\Requests\Users\GetUserRequest;
use Perscom\Http\Requests\Users\GetUsersRequest;
use Perscom\PerscomConnection;
use Saloon\Exceptions\Request\Statuses\UnauthorizedException;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Repositories\ArrayStore;

beforeEach(function () {
    Config::preventStrayRequests();
});

test('it will throw an exception on a failed request', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo',
                'type' => 'bar'
            ]
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $response = $connector->users()->all();

    $data = $response->json();

    expect($response->status())->toEqual(401)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'message' => 'Unauthenticated',
        ]);
})->throws(UnauthorizedException::class);

test('it will throw an authentication exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'AuthenticationException'
            ]
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(AuthenticationException::class);

test('it will throw a not found exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException'
            ]
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(NotFoundHttpException::class);

test('it will throw a tenant not identified exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'TenantCouldNotBeIdentified'
            ]
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(TenantCouldNotBeIdentifiedException::class);

test('it will send the proper parameters in a get all request', function () {
    $mockClient = new MockClient([
        GetUsersRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all(['rank'], 5, 2);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUsersRequest
            && $request->query() instanceof ArrayStore
            && $request->query()->all() == [
                'limit' => 2,
                'page' => 5,
                'include' => 'rank'
            ];
    });
});

test('it will send the proper parameters in a get request', function () {
    $mockClient = new MockClient([
        GetUserRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->get(1, ['rank']);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserRequest
            && $request->id === 1
            && $request->query() instanceof ArrayStore
            && $request->query()->all() == [
                'include' => 'rank'
            ];
    });
});

test('it will send the proper parameters in a relational get all request', function () {
    $mockClient = new MockClient([
        GetUserAssignmentRecordsRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->assignment_records(1)->all(['rank'], 5, 2);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserAssignmentRecordsRequest
            && $request->relationId === 1
            && $request->query() instanceof ArrayStore
            && $request->query()->all() == [
                'limit' => 2,
                'page' => 5,
                'include' => 'rank'
            ];
    });
});

test('it will send the proper parameters in a relational get request', function () {
    $mockClient = new MockClient([
        GetUserAssignmentRecordRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->assignment_records(1)->get(1, ['rank']);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserAssignmentRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->query() instanceof ArrayStore
            && $request->query()->all() == [
                'include' => 'rank'
            ];
    });
});
