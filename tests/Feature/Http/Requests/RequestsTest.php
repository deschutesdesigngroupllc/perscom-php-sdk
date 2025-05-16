<?php

declare(strict_types=1);

use Perscom\Exceptions\AuthenticationException;
use Perscom\Exceptions\ForbiddenException;
use Perscom\Exceptions\NotFoundHttpException;
use Perscom\Exceptions\PaymentRequiredException;
use Perscom\Exceptions\RateLimitException;
use Perscom\Exceptions\ServerErrorException;
use Perscom\Exceptions\ServiceUnavailableException;
use Perscom\Http\Requests\Users\AssignmentRecords\GetUserAssignmentRecordRequest;
use Perscom\Http\Requests\Users\AssignmentRecords\GetUserAssignmentRecordsRequest;
use Perscom\Http\Requests\Users\GetUserRequest;
use Perscom\Http\Requests\Users\GetUsersRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Exceptions\Request\Statuses\UnauthorizedException;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Repositories\ArrayStore;

beforeEach(function () {
    Config::preventStrayRequests();
});

test('it will throw an authentication exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'AuthenticationException',
            ],
        ], 401),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(AuthenticationException::class);

test('it will throw a payment require exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'AuthenticationException',
            ],
        ], 402),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(PaymentRequiredException::class);

test('it will throw a forbidden exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'AuthenticationException',
            ],
        ], 403),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(ForbiddenException::class);

test('it will throw a not found exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException',
            ],
        ], 404),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(NotFoundHttpException::class);

test('it will throw a rate limiter exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException',
            ],
        ], 429),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(RateLimitException::class);

test('it will throw a server error exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException',
            ],
        ], 500),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(ServerErrorException::class);

test('it will throw a service unavailable exception', function () {
    $mockClient = new MockClient([
        MockResponse::make([
            'error' => [
                'message' => 'foo bar',
                'type' => 'NotFoundHttpException',
            ],
        ], 503),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all();
})->throws(ServiceUnavailableException::class);

test('it will send the proper parameters in a get all request', function () {
    $mockClient = new MockClient([
        GetUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->all(['rank'], 5, 2);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUsersRequest
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'limit' => 2,
                'page' => 5,
                'include' => 'rank',
            ];
    });
});

test('it will send the proper parameters in a get request', function () {
    $mockClient = new MockClient([
        GetUserRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->get(1, ['rank']);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserRequest
            && $request->id === 1
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'include' => 'rank',
            ];
    });
});

test('it will send the proper parameters in a relational get all request', function () {
    $mockClient = new MockClient([
        GetUserAssignmentRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->assignment_records(1)->all(['rank'], 5, 2);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserAssignmentRecordsRequest
            && $request->relationId === 1
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'limit' => 2,
                'page' => 5,
                'include' => 'rank',
            ];
    });
});

test('it will send the proper parameters in a relational get request', function () {
    $mockClient = new MockClient([
        GetUserAssignmentRecordRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->assignment_records(1)->get(1, ['rank']);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserAssignmentRecordRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'include' => 'rank',
            ];
    });
});
