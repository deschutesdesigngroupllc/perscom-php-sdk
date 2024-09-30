<?php

declare(strict_types=1);

use Perscom\Http\Requests\Attachments\CreateAttachmentRequest;
use Perscom\Http\Requests\Attachments\DeleteAttachmentRequest;
use Perscom\Http\Requests\Attachments\GetAttachmentRequest;
use Perscom\Http\Requests\Attachments\GetAttachmentsRequest;
use Perscom\Http\Requests\Attachments\SearchAttachmentsRequest;
use Perscom\Http\Requests\Attachments\UpdateAttachmentRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAttachmentsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchAttachmentsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetAttachmentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateAttachmentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateAttachmentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteAttachmentRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all attachments', function () {
    $response = $this->connector->attachments()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetAttachmentsRequest::class);
});

test('it can search attachments', function () {
    $response = $this->connector->attachments()->search('foo');

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

    $this->mockClient->assertSent(SearchAttachmentsRequest::class);
});

test('it can get an attachment', function () {
    $response = $this->connector->attachments()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetAttachmentRequest
            && $request->id === 1;
    });
});

test('it can create an attachment', function () {
    $response = $this->connector->attachments()->create([
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
        return $request instanceof CreateAttachmentRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update an attachment', function () {
    $response = $this->connector->attachments()->update(1, [
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
        return $request instanceof UpdateAttachmentRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete an attachment', function () {
    $response = $this->connector->attachments()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteAttachmentRequest
            && $request->id === 1;
    });
});
