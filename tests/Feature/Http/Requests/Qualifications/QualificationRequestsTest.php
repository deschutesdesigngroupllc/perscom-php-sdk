<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Qualifications\BatchCreateQualificationRequest;
use Perscom\Http\Requests\Qualifications\BatchDeleteQualificationRequest;
use Perscom\Http\Requests\Qualifications\BatchUpdateQualificationRequest;
use Perscom\Http\Requests\Qualifications\CreateQualificationRequest;
use Perscom\Http\Requests\Qualifications\DeleteQualificationRequest;
use Perscom\Http\Requests\Qualifications\GetQualificationRequest;
use Perscom\Http\Requests\Qualifications\GetQualificationsRequest;
use Perscom\Http\Requests\Qualifications\SearchQualificationsRequest;
use Perscom\Http\Requests\Qualifications\UpdateQualificationRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetQualificationsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchQualificationsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetQualificationRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateQualificationRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateQualificationRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteQualificationRequest::class => MockResponse::make([], 201),
        BatchCreateQualificationRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchUpdateQualificationRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
        BatchDeleteQualificationRequest::class => MockResponse::make([
            'data' => [
                'id' => 1,
                'name' => 'foo',
            ],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all qualifications', function () {
    $response = $this->connector->qualifications()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetQualificationsRequest::class);
});

test('it can search qualifications', function () {
    $response = $this->connector->qualifications()->search('foo');

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

    $this->mockClient->assertSent(SearchQualificationsRequest::class);
});

test('it can get a qualification', function () {
    $response = $this->connector->qualifications()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetQualificationRequest
            && $request->id === 1;
    });
});

test('it can create a qualification', function () {
    $response = $this->connector->qualifications()->create([
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
        return $request instanceof CreateQualificationRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a qualification', function () {
    $response = $this->connector->qualifications()->update(1, [
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
        return $request instanceof UpdateQualificationRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a qualification', function () {
    $response = $this->connector->qualifications()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteQualificationRequest
            && $request->id === 1;
    });
});

test('it can batch create qualifications', function () {
    $response = $this->connector->qualifications()->batchCreate(new ResourceObject(data: [
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
        return $request instanceof BatchCreateQualificationRequest;
    });
});

test('it can batch update qualifications', function () {
    $response = $this->connector->qualifications()->batchUpdate(new ResourceObject(1, [
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
        return $request instanceof BatchUpdateQualificationRequest;
    });
});

test('it can batch delete qualifications', function () {
    $response = $this->connector->qualifications()->batchDelete(new ResourceObject(1));

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
        return $request instanceof BatchDeleteQualificationRequest;
    });
});
