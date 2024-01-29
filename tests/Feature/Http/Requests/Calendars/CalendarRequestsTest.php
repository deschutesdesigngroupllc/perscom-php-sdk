<?php

use Perscom\Http\Requests\Calendars\CreateCalendarRequest;
use Perscom\Http\Requests\Calendars\DeleteCalendarRequest;
use Perscom\Http\Requests\Calendars\GetCalendarRequest;
use Perscom\Http\Requests\Calendars\GetCalendarsRequest;
use Perscom\Http\Requests\Calendars\SearchCalendarsRequest;
use Perscom\Http\Requests\Calendars\UpdateCalendarRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\Request;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetCalendarsRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
        SearchCalendarsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo'
                ]
            ]
        ], 200),
        GetCalendarRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        CreateCalendarRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        UpdateCalendarRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        DeleteCalendarRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all calendars', function () {
    $response = $this->connector->calendars()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetCalendarsRequest::class);
});

test('it can search calendars', function () {
    $response = $this->connector->calendars()->search([
        'filters' => [
            ['field' => 'name', 'value' => 'foo']
        ]
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo'
                ]
            ]
        ]);

    $this->mockClient->assertSent(SearchCalendarsRequest::class);
});

test('it can get a calendar', function () {
    $response = $this->connector->calendars()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetCalendarRequest
            && $request->id === 1;
    });
});

test('it can create a calendar', function () {
    $response = $this->connector->calendars()->create([
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
        return $request instanceof CreateCalendarRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a calendar', function () {
    $response = $this->connector->calendars()->update(1, [
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
        return $request instanceof UpdateCalendarRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a calendar', function () {
    $response = $this->connector->calendars()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteCalendarRequest
            && $request->id === 1;
    });
});
