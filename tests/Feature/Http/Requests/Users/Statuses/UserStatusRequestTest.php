<?php

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Users\Statuses\AttachUserStatusRequest;
use Perscom\Http\Requests\Users\Statuses\DetachUserStatusRequest;
use Perscom\Http\Requests\Users\Statuses\SyncUserStatusRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\Response;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        AttachUserStatusRequest::class => MockResponse::make([
            'attached' => [1],
        ]),
        DetachUserStatusRequest::class => MockResponse::make([
            'detached' => [1],
        ]),
        SyncUserStatusRequest::class => MockResponse::make([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can attach a status', function () {
    $resource = new ResourceObject(1, ['text' => 'Test status.']);
    $response = $this->connector->users()->statuses(1)->attach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
        ]);

    $this->mockClient->assertSent(AttachUserStatusRequest::class);
});

test('it can detach a status', function () {
    $resource = new ResourceObject(1);
    $response = $this->connector->users()->statuses(1)->detach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'detached' => [1],
        ]);

    $this->mockClient->assertSent(DetachUserStatusRequest::class);
});

test('it can sync a status', function () {
    $resource = new ResourceObject(1, ['text' => 'Test status.']);
    $response = $this->connector->users()->statuses(1)->sync($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]);

    $this->mockClient->assertSent(SyncUserStatusRequest::class);
});
