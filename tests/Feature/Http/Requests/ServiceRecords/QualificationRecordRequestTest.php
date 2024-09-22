<?php

use Perscom\Http\Requests\ServiceRecords\CreateServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\DeleteServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\GetServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\GetServiceRecordsRequest;
use Perscom\Http\Requests\ServiceRecords\UpdateServiceRecordRequest;
use Perscom\PerscomConnection;
use Saloon\Http\Request;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetServiceRecordsRequest::class => MockResponse::make([
            'name' => 'foo',
        ], 200),
        GetServiceRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        CreateServiceRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        UpdateServiceRecordRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ], 200),
        DeleteServiceRecordRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all service records', function () {
    $response = $this->connector->serviceRecords()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetServiceRecordsRequest::class);
});

test('it can get a service record', function () {
    $response = $this->connector->serviceRecords()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetServiceRecordRequest
            && $request->id === 1;
    });
});

test('it can create a service record', function () {
    $response = $this->connector->serviceRecords()->create([
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
        return $request instanceof CreateServiceRecordRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a service record', function () {
    $response = $this->connector->serviceRecords()->update(1, [
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
        return $request instanceof UpdateServiceRecordRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a service record', function () {
    $response = $this->connector->serviceRecords()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteServiceRecordRequest
            && $request->id === 1;
    });
});
