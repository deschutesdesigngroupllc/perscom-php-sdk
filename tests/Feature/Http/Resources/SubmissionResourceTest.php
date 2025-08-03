<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\CreateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Crud\UpdateRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\Http\Resources\Submissions\StatusResource;
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
                    'title' => 'Test Submission',
                    'content' => 'Submission content',
                    'status' => 'pending',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Submission',
                    'content' => 'Submission content',
                    'status' => 'pending',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Test Submission',
            'content' => 'Submission content',
            'status' => 'pending',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Test Submission',
            'content' => 'Submission content',
            'status' => 'pending',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'title' => 'Updated Submission',
            'content' => 'Updated content',
            'status' => 'approved',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Submission',
                    'content' => 'Submission content',
                    'status' => 'pending',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Updated Submission',
                    'content' => 'Updated content',
                    'status' => 'approved',
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

test('it can get all submissions', function () {
    $response = $this->connector->submissions()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Submission',
                    'content' => 'Submission content',
                    'status' => 'pending',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search submissions', function () {
    $response = $this->connector->submissions()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Submission',
                    'content' => 'Submission content',
                    'status' => 'pending',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a submission', function () {
    $response = $this->connector->submissions()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Test Submission',
            'content' => 'Submission content',
            'status' => 'pending',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a submission', function () {
    $response = $this->connector->submissions()->create([
        'title' => 'Test Submission',
        'content' => 'Submission content',
        'status' => 'pending',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Test Submission',
            'content' => 'Submission content',
            'status' => 'pending',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['title'] === 'Test Submission';
    });
});

test('it can update a submission', function () {
    $response = $this->connector->submissions()->update(1, [
        'title' => 'Updated Submission',
        'content' => 'Updated content',
        'status' => 'approved',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'title' => 'Updated Submission',
            'content' => 'Updated content',
            'status' => 'approved',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['title'] === 'Updated Submission';
    });
});

test('it can delete a submission', function () {
    $response = $this->connector->submissions()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create submissions', function () {
    $response = $this->connector->submissions()->batchCreate(new ResourceObject(data: [
        'title' => 'Test Submission',
        'content' => 'Submission content',
        'status' => 'pending',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Test Submission',
                    'content' => 'Submission content',
                    'status' => 'pending',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'submissions';
    });
});

test('it can batch update submissions', function () {
    $response = $this->connector->submissions()->batchUpdate(new ResourceObject(1, [
        'title' => 'Updated Submission',
        'content' => 'Updated content',
        'status' => 'approved',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Updated Submission',
                    'content' => 'Updated content',
                    'status' => 'approved',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'submissions';
    });
});

test('it can batch delete submissions', function () {
    $response = $this->connector->submissions()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'submissions';
    });
});

test('it can get submission statuses resource', function () {
    $statusResource = $this->connector->submissions()->statuses(1);

    expect($statusResource)->toBeInstanceOf(StatusResource::class);
});
