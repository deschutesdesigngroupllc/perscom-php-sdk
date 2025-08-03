<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Attach\AttachRequest;
use Perscom\Http\Requests\Attach\DetachRequest;
use Perscom\Http\Requests\Attach\SyncRequest;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Multipart\CreateMultipartRequest;
use Perscom\Http\Requests\Multipart\UpdateMultipartRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\Http\Resources\Users\AttachmentsResource;
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
                    'filename' => 'user_attachment.pdf',
                    'user_id' => 1,
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'user_attachment.pdf',
                    'user_id' => 1,
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'user_attachment.pdf',
            'user_id' => 1,
        ]),
        CreateMultipartRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'user_attachment.pdf',
            'user_id' => 1,
        ]),
        UpdateMultipartRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'updated_attachment.pdf',
            'user_id' => 1,
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'user_attachment.pdf',
                    'user_id' => 1,
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'updated_attachment.pdf',
                    'user_id' => 1,
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
        AttachRequest::class => MockResponse::make([
            'attached' => [1],
        ]),
        DetachRequest::class => MockResponse::make([
            'detached' => [1],
        ]),
        SyncRequest::class => MockResponse::make([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);

    $this->resource = new AttachmentsResource($this->connector, 'users/1/attachments');
});

test('it can get all user attachments', function () {
    $response = $this->resource->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'user_attachment.pdf',
                    'user_id' => 1,
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search user attachments', function () {
    $response = $this->resource->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'user_attachment.pdf',
                    'user_id' => 1,
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a user attachment', function () {
    $response = $this->resource->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'user_attachment.pdf',
            'user_id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a user attachment using multipart', function () {
    $response = $this->resource->create([
        'file' => 'test file content',
        'filename' => 'user_attachment.pdf',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'user_attachment.pdf',
            'user_id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateMultipartRequest
            && $request->resource === 'users/1/attachments'
            && $request->data['filename'] === 'user_attachment.pdf';
    });
});

test('it can update a user attachment using multipart', function () {
    $response = $this->resource->update(1, [
        'filename' => 'updated_attachment.pdf',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'updated_attachment.pdf',
            'user_id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateMultipartRequest
            && $request->resource === 'users/1/attachments'
            && $request->id === 1
            && $request->data['filename'] === 'updated_attachment.pdf';
    });
});

test('it can delete a user attachment', function () {
    $response = $this->resource->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create user attachments', function () {
    $response = $this->resource->batchCreate(new ResourceObject(data: [
        'filename' => 'user_attachment.pdf',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'user_attachment.pdf',
                    'user_id' => 1,
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'users/1/attachments';
    });
});

test('it can batch update user attachments', function () {
    $response = $this->resource->batchUpdate(new ResourceObject(1, [
        'filename' => 'updated_attachment.pdf',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'updated_attachment.pdf',
                    'user_id' => 1,
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'users/1/attachments';
    });
});

test('it can batch delete user attachments', function () {
    $response = $this->resource->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'users/1/attachments';
    });
});

test('it can attach user attachments', function () {
    $response = $this->resource->attach(new ResourceObject(1), 'categories');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
        ]);

    $this->mockClient->assertSent(AttachRequest::class);
});

test('it can detach user attachments', function () {
    $response = $this->resource->detach(new ResourceObject(1), 'categories');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'detached' => [1],
        ]);

    $this->mockClient->assertSent(DetachRequest::class);
});

test('it can sync user attachments', function () {
    $response = $this->resource->sync(new ResourceObject(1), 'categories');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
            'detached' => [],
            'updated' => [],
        ]);

    $this->mockClient->assertSent(SyncRequest::class);
});
