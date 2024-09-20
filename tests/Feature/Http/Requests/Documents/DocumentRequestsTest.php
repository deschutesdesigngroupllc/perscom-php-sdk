<?php

use Perscom\Http\Requests\Documents\CreateDocumentRequest;
use Perscom\Http\Requests\Documents\DeleteDocumentRequest;
use Perscom\Http\Requests\Documents\GetDocumentRequest;
use Perscom\Http\Requests\Documents\GetDocumentsRequest;
use Perscom\Http\Requests\Documents\SearchDocumentsRequest;
use Perscom\Http\Requests\Documents\UpdateDocumentRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetDocumentsRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        SearchDocumentsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ], 200),
        GetDocumentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateDocumentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateDocumentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteDocumentRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all documents', function () {
    $response = $this->connector->documents()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetDocumentsRequest::class);
});

test('it can search documents', function () {
    $response = $this->connector->documents()->search('foo');

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

    $this->mockClient->assertSent(SearchDocumentsRequest::class);
});

test('it can get a document', function () {
    $response = $this->connector->documents()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetDocumentRequest
            && $request->id === 1;
    });
});

test('it can create a document', function () {
    $response = $this->connector->documents()->create([
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
        return $request instanceof CreateDocumentRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a document', function () {
    $response = $this->connector->documents()->update(1, [
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
        return $request instanceof UpdateDocumentRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a document', function () {
    $response = $this->connector->documents()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteDocumentRequest
            && $request->id === 1;
    });
});
