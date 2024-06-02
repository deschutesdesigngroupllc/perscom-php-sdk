<?php

namespace Perscom\Test\Feature\Http\Requests;

use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Users\SearchUsersRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\ArrayStore;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Repositories\Body\JsonBodyRepository;

test('can properly format the query parameters', function () {
    $mockClient = new MockClient([
        SearchUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->search(include: 'foo', page: 3, limit: 100);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchUsersRequest
            && $request->query() instanceof ArrayStore
            && $request->query()->all() == [
                'include' => 'foo',
                'page' => 3,
                'limit' => 100,
            ];
    });
});

test('can properly format a search value argument', function () {
    $mockClient = new MockClient([
        SearchUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->search(value: 'foo');

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchUsersRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() == [
                'search' => [
                    'value' => 'foo',
                ],
            ];
    });
});

test('can properly format a single sort argument', function () {
    $mockClient = new MockClient([
        SearchUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->search(sort: new SortObject('foo', 'asc'));

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchUsersRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() == [
                'sort' => [
                    ['field' => 'foo', 'direction' => 'asc'],
                ],
            ];
    });
});

test('can properly format an array of sort arguments', function () {
    $mockClient = new MockClient([
        SearchUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->search(sort: [new SortObject('foo', 'asc'), new SortObject('bar', 'desc')]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchUsersRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() == [
                'sort' => [
                    ['field' => 'foo', 'direction' => 'asc'],
                    ['field' => 'bar', 'direction' => 'desc'],
                ],
            ];
    });
});

test('can properly format a single filter argument', function () {
    $mockClient = new MockClient([
        SearchUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->search(filter: new FilterObject('foo', '=', 'bar'));

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchUsersRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() == [
                'filters' => [
                    ['field' => 'foo', 'operator' => '=', 'value' => 'bar', 'type' => 'or'],
                ],
            ];
    });
});

test('can properly format an array of filter arguments', function () {
    $mockClient = new MockClient([
        SearchUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->search(filter: [new FilterObject('foo', '=', 'bar', 'or'), new FilterObject('bar', '=', 'foo', 'and')]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchUsersRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() == [
                'filters' => [
                    ['field' => 'foo', 'operator' => '=', 'value' => 'bar', 'type' => 'or'],
                    ['field' => 'bar', 'operator' => '=', 'value' => 'foo', 'type' => 'and'],
                ],
            ];
    });
});

test('can properly format a single scope argument', function () {
    $mockClient = new MockClient([
        SearchUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->search(scope: new ScopeObject('foo', ['bar']));

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchUsersRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() == [
                'scopes' => [
                    ['name' => 'foo', 'parameters' => ['bar']],
                ],
            ];
    });
});

test('can properly format an array of scope arguments', function () {
    $mockClient = new MockClient([
        SearchUsersRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
    ]);

    $connector = new PerscomConnection('foo', 'bar');
    $connector->withMockClient($mockClient);
    $connector->users()->search(scope: [new ScopeObject('foo'), new ScopeObject('bar')]);

    $mockClient->assertSent(function (Request $request) {
        return $request instanceof SearchUsersRequest
            && $request->body() instanceof JsonBodyRepository
            && $request->body()->all() == [
                'scopes' => [
                    ['name' => 'foo'],
                    ['name' => 'bar'],
                ],
            ];
    });
});
