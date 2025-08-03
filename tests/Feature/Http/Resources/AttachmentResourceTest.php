<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Multipart\CreateMultipartRequest;
use Perscom\Http\Requests\Multipart\UpdateMultipartRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAllRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.pdf',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.pdf',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'test.pdf',
        ]),
        CreateMultipartRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'test.pdf',
        ]),
        UpdateMultipartRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'updated.pdf',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.pdf',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'updated.pdf',
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
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
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.pdf',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search attachments', function () {
    $response = $this->connector->attachments()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.pdf',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get an attachment', function () {
    $response = $this->connector->attachments()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'test.pdf',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create an attachment using multipart', function () {
    $response = $this->connector->attachments()->create([
        'file' => 'test file content',
        'filename' => 'test.pdf',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'test.pdf',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateMultipartRequest
            && $request->resource === 'attachments'
            && $request->data['filename'] === 'test.pdf';
    });
});

test('it can update an attachment using multipart', function () {
    $response = $this->connector->attachments()->update(1, [
        'filename' => 'updated.pdf',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'updated.pdf',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateMultipartRequest
            && $request->resource === 'attachments'
            && $request->id === 1
            && $request->data['filename'] === 'updated.pdf';
    });
});

test('it can delete an attachment', function () {
    $response = $this->connector->attachments()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create attachments', function () {
    $response = $this->connector->attachments()->batchCreate(new ResourceObject(data: [
        'filename' => 'test.pdf',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.pdf',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'attachments';
    });
});

test('it can batch update attachments', function () {
    $response = $this->connector->attachments()->batchUpdate(new ResourceObject(1, [
        'filename' => 'updated.pdf',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'updated.pdf',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'attachments';
    });
});

test('it can batch delete attachments', function () {
    $response = $this->connector->attachments()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'attachments';
    });
});
