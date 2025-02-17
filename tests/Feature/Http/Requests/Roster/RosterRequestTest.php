<?php

declare(strict_types=1);

use Perscom\Enums\RosterType;
use Perscom\Http\Requests\Roster\GetRosterGroupRequest;
use Perscom\Http\Requests\Roster\GetRosterRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Contracts\ArrayStore;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetRosterRequest::class => MockResponse::make(),
        GetRosterGroupRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get the roster', function () {
    $response = $this->connector->roster()->all();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class);

    $this->mockClient->assertSent(GetRosterRequest::class);
});

test('it can get the roster by type', function () {
    $response = $this->connector->roster(type: RosterType::Manual)->all();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRosterRequest
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'limit' => 20,
                'page' => 1,
                'type' => RosterType::Manual->value,
            ];
    });
});

test('it can get the roster with included relations', function () {
    $response = $this->connector->roster()->all(include: ['foo', 'bar'], page: 5, limit: 2);

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRosterRequest
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'limit' => 2,
                'page' => 5,
                'type' => RosterType::Automatic->value,
                'include' => 'foo,bar',
            ];
    });
});

test('it can get a roster by group', function () {
    $response = $this->connector->roster()->group(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRosterGroupRequest
            && $request->id === 1;
    });
});

test('it can get a roster by group and roster type with included relations', function () {
    $response = $this->connector->roster(type: RosterType::Manual)->group(id: 1, include: ['foo', 'bar']);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRosterGroupRequest
            && $request->id === 1
            && $request->query() instanceof ArrayStore
            && $request->query()->all() === [
                'type' => RosterType::Manual->value,
                'include' => 'foo,bar'
            ];
    });
});
