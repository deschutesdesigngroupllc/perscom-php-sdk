<?php

use Perscom\Http\Requests\Announcements\CreateAnnouncementRequest;
use Perscom\Http\Requests\Announcements\DeleteAnnouncementRequest;
use Perscom\Http\Requests\Announcements\GetAnnouncementRequest;
use Perscom\Http\Requests\Announcements\GetAnnouncementsRequest;
use Perscom\Http\Requests\Announcements\SearchAnnouncementsRequest;
use Perscom\Http\Requests\Announcements\UpdateAnnouncementRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\Request;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAnnouncementsRequest::class => MockResponse::make([
            'name' => 'foo'
        ], 200),
        SearchAnnouncementsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo'
                ]
            ]
        ], 200),
        GetAnnouncementRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        CreateAnnouncementRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        UpdateAnnouncementRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo'
        ], 200),
        DeleteAnnouncementRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all announcements', function () {
    $response = $this->connector->announcements()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetAnnouncementsRequest::class);
});

test('it can search announcements', function () {
    $response = $this->connector->announcements()->search('foo');

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

    $this->mockClient->assertSent(SearchAnnouncementsRequest::class);
});

test('it can get a announcement', function () {
    $response = $this->connector->announcements()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetAnnouncementRequest
            && $request->id === 1;
    });
});

test('it can create a announcement', function () {
    $response = $this->connector->announcements()->create([
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
        return $request instanceof CreateAnnouncementRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a announcement', function () {
    $response = $this->connector->announcements()->update(1, [
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
        return $request instanceof UpdateAnnouncementRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a announcement', function () {
    $response = $this->connector->announcements()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteAnnouncementRequest
            && $request->id === 1;
    });
});
