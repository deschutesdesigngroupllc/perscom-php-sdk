<?php

declare(strict_types=1);

use Perscom\Http\Requests\Issuers\CreateIssuerRequest;
use Perscom\Http\Requests\Issuers\DeleteIssuerRequest;
use Perscom\Http\Requests\Issuers\GetIssuerRequest;
use Perscom\Http\Requests\Issuers\GetIssuersRequest;
use Perscom\Http\Requests\Issuers\SearchIssuersRequest;
use Perscom\Http\Requests\Issuers\UpdateIssuerRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetIssuersRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchIssuersRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetIssuerRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateIssuerRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateIssuerRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteIssuerRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all issuers', function () {
    $response = $this->connector->issuers()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetIssuersRequest::class);
});

test('it can search issuers', function () {
    $response = $this->connector->issuers()->search('foo');

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

    $this->mockClient->assertSent(SearchIssuersRequest::class);
});

test('it can get an issuer', function () {
    $response = $this->connector->issuers()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetIssuerRequest
            && $request->id === 1;
    });
});

test('it can create an issuer', function () {
    $response = $this->connector->issuers()->create([
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
        return $request instanceof CreateIssuerRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update an issuer', function () {
    $response = $this->connector->issuers()->update(1, [
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
        return $request instanceof UpdateIssuerRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete an issuer', function () {
    $response = $this->connector->issuers()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteIssuerRequest
            && $request->id === 1;
    });
});
