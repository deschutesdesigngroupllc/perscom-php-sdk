<?php

declare(strict_types=1);

use Perscom\Http\Requests\Messages\CreateMessageRequest;
use Perscom\Http\Requests\Messages\DeleteMessageRequest;
use Perscom\Http\Requests\Messages\GetMessageRequest;
use Perscom\Http\Requests\Messages\GetMessagesRequest;
use Perscom\Http\Requests\Messages\SearchMessagesRequest;
use Perscom\Http\Requests\Messages\UpdateMessageRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetMessagesRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchMessagesRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetMessageRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateMessageRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateMessageRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteMessageRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all messages', function () {
    $response = $this->connector->messages()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetMessagesRequest::class);
});

test('it can search messages', function () {
    $response = $this->connector->messages()->search('foo');

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

    $this->mockClient->assertSent(SearchMessagesRequest::class);
});

test('it can get an message', function () {
    $response = $this->connector->messages()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetMessageRequest
            && $request->id === 1;
    });
});

test('it can create an message', function () {
    $response = $this->connector->messages()->create([
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
        return $request instanceof CreateMessageRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update an message', function () {
    $response = $this->connector->messages()->update(1, [
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
        return $request instanceof UpdateMessageRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete an message', function () {
    $response = $this->connector->messages()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteMessageRequest
            && $request->id === 1;
    });
});
