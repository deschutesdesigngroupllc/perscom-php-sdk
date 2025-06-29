<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Common\CreateImageRequest;
use Perscom\Http\Requests\Common\DeleteImageRequest;
use Perscom\Http\Requests\Common\GetImageRequest;
use Perscom\Http\Requests\Common\UpdateImageRequest;
use Perscom\Http\Requests\Units\BatchCreateUnitRequest;
use Perscom\Http\Requests\Units\BatchDeleteUnitRequest;
use Perscom\Http\Requests\Units\BatchUpdateUnitRequest;
use Perscom\Http\Requests\Units\CreateUnitRequest;
use Perscom\Http\Requests\Units\DeleteUnitRequest;
use Perscom\Http\Requests\Units\GetUnitRequest;
use Perscom\Http\Requests\Units\GetUnitsRequest;
use Perscom\Http\Requests\Units\SearchUnitsRequest;
use Perscom\Http\Requests\Units\UpdateUnitRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUnitsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchUnitsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetUnitRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateUnitRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateUnitRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteUnitRequest::class => MockResponse::make([], 201),
        BatchCreateUnitRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchUpdateUnitRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchDeleteUnitRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        GetImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        CreateImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        DeleteImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        UpdateImageRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all units', function () {
    $response = $this->connector->units()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUnitsRequest::class);
});

test('it can search units', function () {
    $response = $this->connector->units()->search('foo');

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

    $this->mockClient->assertSent(SearchUnitsRequest::class);
});

test('it can get a unit', function () {
    $response = $this->connector->units()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUnitRequest
            && $request->id === 1;
    });
});

test('it can create a unit', function () {
    $response = $this->connector->units()->create([
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
        return $request instanceof CreateUnitRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a unit', function () {
    $response = $this->connector->units()->update(1, [
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
        return $request instanceof UpdateUnitRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a unit', function () {
    $response = $this->connector->units()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUnitRequest
            && $request->id === 1;
    });
});

test('it can batch create units', function () {
    $response = $this->connector->units()->batchCreate(new ResourceObject(data: [
        'foo' => 'bar',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateUnitRequest;
    });
});

test('it can batch update units', function () {
    $response = $this->connector->units()->batchUpdate(new ResourceObject(1, [
        'foo' => 'bar',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateUnitRequest;
    });
});

test('it can batch delete units', function () {
    $response = $this->connector->units()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteUnitRequest;
    });
});

test('it can get the unit image', function () {
    $response = $this->connector->units()->imageGet(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetImageRequest;
    });
});

test('it can create the unit image', function () {
    $response = $this->connector->units()->imageCreate(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateImageRequest;
    });
});

test('it can delete the unit image', function () {
    $response = $this->connector->units()->imageDelete(1, [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteImageRequest;
    });
});

test('it can update the unit image', function () {
    $response = $this->connector->units()->imageUpdate(1, [
        'foo' => 'bar',
    ], [
        'foo' => 'bar',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateImageRequest;
    });
});
