<?php

declare(strict_types=1);

use Perscom\Http\Requests\Common\CreateImageRequest;
use Perscom\Http\Requests\Common\DeleteImageRequest;
use Perscom\Http\Requests\Common\GetImageRequest;
use Perscom\Http\Requests\Common\UpdateImageRequest;
use Perscom\Http\Requests\Events\CreateEventRequest;
use Perscom\Http\Requests\Events\DeleteEventRequest;
use Perscom\Http\Requests\Events\GetEventRequest;
use Perscom\Http\Requests\Events\GetEventsRequest;
use Perscom\Http\Requests\Events\SearchEventsRequest;
use Perscom\Http\Requests\Events\UpdateEventRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetEventsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchEventsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetEventRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateEventRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateEventRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteEventRequest::class => MockResponse::make([], 201),
        GetImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        CreateImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        DeleteImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        UpdateImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all events', function () {
    $response = $this->connector->events()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetEventsRequest::class);
});

test('it can search events', function () {
    $response = $this->connector->events()->search('foo');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchEventsRequest::class);
});

test('it can get an event', function () {
    $response = $this->connector->events()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetEventRequest
            && $request->id === 1;
    });
});

test('it can create an event', function () {
    $response = $this->connector->events()->create([
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
        return $request instanceof CreateEventRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update an event', function () {
    $response = $this->connector->events()->update(1, [
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
        return $request instanceof UpdateEventRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete an event', function () {
    $response = $this->connector->events()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteEventRequest
            && $request->id === 1;
    });
});

test('it can get the event image', function () {
    $response = $this->connector->events()->imageGet(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetImageRequest;
    });
});

test('it can create the event image', function () {
    $response = $this->connector->events()->imageCreate(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateImageRequest;
    });
});

test('it can delete the event image', function () {
    $response = $this->connector->events()->imageDelete(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteImageRequest;
    });
});

test('it can update the event image', function () {
    $response = $this->connector->events()->imageUpdate(1, [
        'foo' => 'bar',
    ], [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateImageRequest;
    });
});
