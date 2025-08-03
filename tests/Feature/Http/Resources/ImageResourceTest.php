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
                    'filename' => 'test.jpg',
                    'url' => 'https://example.com/test.jpg',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.jpg',
                    'url' => 'https://example.com/test.jpg',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'test.jpg',
            'url' => 'https://example.com/test.jpg',
        ]),
        CreateMultipartRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'test.jpg',
            'url' => 'https://example.com/test.jpg',
        ]),
        UpdateMultipartRequest::class => MockResponse::make([
            'id' => 1,
            'filename' => 'updated.jpg',
            'url' => 'https://example.com/updated.jpg',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.jpg',
                    'url' => 'https://example.com/test.jpg',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'updated.jpg',
                    'url' => 'https://example.com/updated.jpg',
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

test('it can get all images', function () {
    $response = $this->connector->images()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.jpg',
                    'url' => 'https://example.com/test.jpg',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search images', function () {
    $response = $this->connector->images()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.jpg',
                    'url' => 'https://example.com/test.jpg',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get an image', function () {
    $response = $this->connector->images()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'test.jpg',
            'url' => 'https://example.com/test.jpg',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create an image using multipart', function () {
    $response = $this->connector->images()->create([
        'file' => 'test image content',
        'filename' => 'test.jpg',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'test.jpg',
            'url' => 'https://example.com/test.jpg',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateMultipartRequest
            && $request->resource === 'images'
            && $request->data['filename'] === 'test.jpg';
    });
});

test('it can update an image using multipart', function () {
    $response = $this->connector->images()->update(1, [
        'filename' => 'updated.jpg',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'filename' => 'updated.jpg',
            'url' => 'https://example.com/updated.jpg',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateMultipartRequest
            && $request->resource === 'images'
            && $request->id === 1
            && $request->data['filename'] === 'updated.jpg';
    });
});

test('it can delete an image', function () {
    $response = $this->connector->images()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create images', function () {
    $response = $this->connector->images()->batchCreate(new ResourceObject(data: [
        'filename' => 'test.jpg',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'test.jpg',
                    'url' => 'https://example.com/test.jpg',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'images';
    });
});

test('it can batch update images', function () {
    $response = $this->connector->images()->batchUpdate(new ResourceObject(1, [
        'filename' => 'updated.jpg',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'filename' => 'updated.jpg',
                    'url' => 'https://example.com/updated.jpg',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'images';
    });
});

test('it can batch delete images', function () {
    $response = $this->connector->images()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'images';
    });
});
