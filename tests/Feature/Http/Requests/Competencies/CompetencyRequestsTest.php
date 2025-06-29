<?php

declare(strict_types=1);

use Perscom\Http\Requests\Competencies\CreateCompetencyRequest;
use Perscom\Http\Requests\Competencies\DeleteCompetencyRequest;
use Perscom\Http\Requests\Competencies\GetCompetenciesRequest;
use Perscom\Http\Requests\Competencies\GetCompetencyRequest;
use Perscom\Http\Requests\Competencies\SearchCompetenciesRequest;
use Perscom\Http\Requests\Competencies\UpdateCompetencyRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetCompetenciesRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        SearchCompetenciesRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'foo',
                ],
            ],
        ]),
        GetCompetencyRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateCompetencyRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateCompetencyRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteCompetencyRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all competencies', function () {
    $response = $this->connector->competencies()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetCompetenciesRequest::class);
});

test('it can search competencies', function () {
    $response = $this->connector->competencies()->search('foo');

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

    $this->mockClient->assertSent(SearchCompetenciesRequest::class);
});

test('it can get a competency', function () {
    $response = $this->connector->competencies()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetCompetencyRequest
            && $request->id === 1;
    });
});

test('it can create a competency', function () {
    $response = $this->connector->competencies()->create([
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
        return $request instanceof CreateCompetencyRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a competency', function () {
    $response = $this->connector->competencies()->update(1, [
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
        return $request instanceof UpdateCompetencyRequest
            && $request->id === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a competency', function () {
    $response = $this->connector->competencies()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteCompetencyRequest
            && $request->id === 1;
    });
});
