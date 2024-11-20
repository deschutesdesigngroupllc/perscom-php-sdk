<?php

declare(strict_types=1);

use Perscom\Http\Requests\Users\Attachments\CreateUserAttachmentRequest;
use Perscom\Http\Requests\Users\Attachments\DeleteUserAttachmentRequest;
use Perscom\Http\Requests\Users\Attachments\GetUserAttachmentRequest;
use Perscom\Http\Requests\Users\Attachments\GetUserAttachmentsRequest;
use Perscom\Http\Requests\Users\Attachments\UpdateUserAttachmentRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Data\MultipartValue;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Contracts\Body\HasBody;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetUserAttachmentsRequest::class => MockResponse::make([
            'name' => 'foo',
        ]),
        GetUserAttachmentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        CreateUserAttachmentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        UpdateUserAttachmentRequest::class => MockResponse::make([
            'id' => 1,
            'name' => 'foo',
        ]),
        DeleteUserAttachmentRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users attachments', function () {
    $response = $this->connector->users()->attachments(1)->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
        ]);

    $this->mockClient->assertSent(GetUserAttachmentsRequest::class);
});

test('it can get a users attachment', function () {
    $response = $this->connector->users()->attachments(1)->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'name' => 'foo',
            'id' => 1,
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetUserAttachmentRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});

test('it can create a users attachment', function () {
    $response = $this->connector->users()->attachments(1)->create([
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
        return $request instanceof CreateUserAttachmentRequest
            && $request->data['foo'] === 'bar';
    });
});

test('it can update a users attachment', function () {
    $response = $this->connector->users()->attachments(1)->update(1, [
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
        return $request instanceof UpdateUserAttachmentRequest
            && $request->relationId === 1
            && $request->resourceId === 1
            && $request->data['foo'] === 'bar';
    });
});

test('it can delete a users attachment', function () {
    $response = $this->connector->users()->attachments(1)->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUserAttachmentRequest
            && $request->relationId === 1
            && $request->resourceId === 1;
    });
});
