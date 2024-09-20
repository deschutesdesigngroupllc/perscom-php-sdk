<?php

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Submissions\Statuses\AttachSubmissionStatusRequest;
use Perscom\Http\Requests\Submissions\Statuses\DetachSubmissionStatusRequest;
use Perscom\Http\Requests\Submissions\Statuses\SyncSubmissionStatusRequest;
use Perscom\PerscomConnection;
use Saloon\Http\Response;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        AttachSubmissionStatusRequest::class => MockResponse::make([
            'attached' => [1],
        ]),
        DetachSubmissionStatusRequest::class => MockResponse::make([
            'detached' => [1],
        ]),
        SyncSubmissionStatusRequest::class => MockResponse::make([
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
    $response = $this->connector->submissions()->statuses(1)->attach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
        ]);

    $this->mockClient->assertSent(AttachSubmissionStatusRequest::class);
});

test('it can detach a status', function () {
    $resource = new ResourceObject(1);
    $response = $this->connector->submissions()->statuses(1)->detach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'detached' => [1],
        ]);

    $this->mockClient->assertSent(DetachSubmissionStatusRequest::class);
});

test('it can sync a status', function () {
    $resource = new ResourceObject(1, ['text' => 'Test status.']);
    $response = $this->connector->submissions()->statuses(1)->sync($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]);

    $this->mockClient->assertSent(SyncSubmissionStatusRequest::class);
});
