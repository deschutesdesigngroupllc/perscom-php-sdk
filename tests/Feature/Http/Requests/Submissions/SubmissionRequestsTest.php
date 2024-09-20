<?php

use Perscom\Http\Requests\Submissions\CreateSubmissionRequest;
use Perscom\Http\Requests\Submissions\DeleteSubmissionRequest;
use Perscom\Http\Requests\Submissions\GetSubmissionRequest;
use Perscom\Http\Requests\Submissions\GetSubmissionsRequest;
use Perscom\Http\Requests\Submissions\SearchSubmissionsRequest;
use Perscom\Http\Requests\Submissions\UpdateSubmissionRequest;
use Perscom\PerscomConnection;
use Saloon\Http\Request;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetSubmissionsRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        SearchSubmissionsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ], 200),
        GetSubmissionRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateSubmissionRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateSubmissionRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteSubmissionRequest::class => MockResponse::make([], 201),
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
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetSubmissionsRequest::class);
});

test('it can search submissions', function () {
    $response = $this->connector->submissions()->search('foo');

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

    $this->mockClient->assertSent(SearchSubmissionsRequest::class);
});

test('it can get a submission', function () {
    $response = $this->connector->submissions()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetSubmissionRequest
            && $request->id === 1;
    });
});

test('it can create a submission', function () {
    $response = $this->connector->submissions()->create([
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
        return $request instanceof CreateSubmissionRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a submission', function () {
    $response = $this->connector->submissions()->update(1, [
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
        return $request instanceof UpdateSubmissionRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a submission', function () {
    $response = $this->connector->submissions()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteSubmissionRequest
            && $request->id === 1;
    });
});
