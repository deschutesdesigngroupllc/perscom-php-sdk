<?php

declare(strict_types=1);

use Perscom\Http\Requests\Credentials\CreateCredentialRequest;
use Perscom\Http\Requests\Credentials\DeleteCredentialRequest;
use Perscom\Http\Requests\Credentials\GetCredentialRequest;
use Perscom\Http\Requests\Credentials\GetCredentialsRequest;
use Perscom\Http\Requests\Credentials\SearchCredentialsRequest;
use Perscom\Http\Requests\Credentials\UpdateCredentialRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetCredentialsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchCredentialsRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetCredentialRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateCredentialRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateCredentialRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteCredentialRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all credentials', function () {
    $response = $this->connector->credentials()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetCredentialsRequest::class);
});

test('it can search credentials', function () {
    $response = $this->connector->credentials()->search('foo');

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

    $this->mockClient->assertSent(SearchCredentialsRequest::class);
});

test('it can get a credential', function () {
    $response = $this->connector->credentials()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetCredentialRequest
            && $request->id === 1;
    });
});

test('it can create a credential', function () {
    $response = $this->connector->credentials()->create([
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
        return $request instanceof CreateCredentialRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a credential', function () {
    $response = $this->connector->credentials()->update(1, [
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
        return $request instanceof UpdateCredentialRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a credential', function () {
    $response = $this->connector->credentials()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteCredentialRequest
            && $request->id === 1;
    });
});
