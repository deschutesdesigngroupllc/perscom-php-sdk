<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Attach\AttachRequest;
use Perscom\Http\Requests\Attach\DetachRequest;
use Perscom\Http\Requests\Attach\SyncRequest;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\CreateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Crud\UpdateRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\Http\Resources\Forms\FieldResource;
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
                    'name' => 'Test Field',
                    'type' => 'text',
                    'form_id' => 1,
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Field',
                    'type' => 'text',
                    'form_id' => 1,
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Test Field',
            'type' => 'text',
            'form_id' => 1,
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Test Field',
            'type' => 'text',
            'form_id' => 1,
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'Updated Field',
            'type' => 'textarea',
            'form_id' => 1,
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Field',
                    'type' => 'text',
                    'form_id' => 1,
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Updated Field',
                    'type' => 'textarea',
                    'form_id' => 1,
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

    $this->resource = new FieldResource($this->connector, 'forms/1/fields');
});

test('it can get all form fields', function () {
    $response = $this->resource->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Field',
                    'type' => 'text',
                    'form_id' => 1,
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search form fields', function () {
    $response = $this->resource->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Field',
                    'type' => 'text',
                    'form_id' => 1,
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a form field', function () {
    $response = $this->resource->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Test Field',
            'type' => 'text',
            'form_id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a form field', function () {
    $response = $this->resource->create([
        'name' => 'Test Field',
        'type' => 'text',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Test Field',
            'type' => 'text',
            'form_id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['name'] === 'Test Field';
    });
});

test('it can update a form field', function () {
    $response = $this->resource->update(1, [
        'name' => 'Updated Field',
        'type' => 'textarea',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'name' => 'Updated Field',
            'type' => 'textarea',
            'form_id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['name'] === 'Updated Field';
    });
});

test('it can delete a form field', function () {
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

test('it can batch create form fields', function () {
    $response = $this->resource->batchCreate(new ResourceObject(data: [
        'name' => 'Test Field',
        'type' => 'text',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test Field',
                    'type' => 'text',
                    'form_id' => 1,
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'forms/1/fields';
    });
});

test('it can batch update form fields', function () {
    $response = $this->resource->batchUpdate(new ResourceObject(1, [
        'name' => 'Updated Field',
        'type' => 'textarea',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Updated Field',
                    'type' => 'textarea',
                    'form_id' => 1,
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'forms/1/fields';
    });
});

test('it can batch delete form fields', function () {
    $response = $this->resource->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'forms/1/fields';
    });
});

test('it can attach form field relations', function () {
    $resource = new ResourceObject(1, ['category_id' => 1]);
    $response = $this->resource->attach($resource, 'categories');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1],
        ]);

    $this->mockClient->assertSent(AttachRequest::class);
});

test('it can detach form field relations', function () {
    $resource = new ResourceObject(1);
    $response = $this->resource->detach($resource, 'categories');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'detached' => [1],
        ]);

    $this->mockClient->assertSent(DetachRequest::class);
});

test('it can sync form field relations', function () {
    $resource = new ResourceObject(1, ['category_id' => 1]);
    $response = $this->resource->sync($resource, 'categories');

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
