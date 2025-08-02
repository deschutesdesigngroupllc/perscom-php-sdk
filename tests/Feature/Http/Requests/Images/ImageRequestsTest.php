<?php

declare(strict_types=1);

use Perscom\Http\Requests\Images\CreateImageRequest;
use Perscom\Http\Requests\Images\DeleteImageRequest;
use Perscom\Http\Requests\Images\GetImageRequest;
use Perscom\Http\Requests\Images\GetImagesRequest;
use Perscom\Http\Requests\Images\UpdateImageRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetImagesRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetImageRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateImageRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateImageRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteImageRequest::class => MockResponse::make([], 201),
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
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetImagesRequest::class);
});

test('it can search images', function () {
    $response = $this->connector->images()->search('foo');

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

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get an image', function () {
    $response = $this->connector->images()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetImageRequest
            && $request->id === 1;
    });
});

test('it can create an image', function () {
    $response = $this->connector->images()->create([
        'foo' => 'bar',
    ]);

    $data = $response->json();

    /** @var HasBody $request */
    $request = $response->getRequest();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($request->body()->all())->toContainOnlyInstancesOf(MultipartValue::class)
        ->and($request->body()->all())->toBeArray()
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateImageRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update an image', function () {
    $response = $this->connector->images()->update(1, [
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
        return $request instanceof UpdateImageRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete an image', function () {
    $response = $this->connector->images()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteImageRequest
            && $request->id === 1;
    });
});
