<?php

declare(strict_types=1);

use Perscom\Http\Requests\Users\CoverPhoto\CreateUserCoverPhotoRequest;
use Perscom\Http\Requests\Users\CoverPhoto\DeleteUserCoverPhotoRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Data\MultipartValue;
use Saloon\Exceptions\SaloonException;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Contracts\Body\HasBody;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        CreateUserCoverPhotoRequest::class => MockResponse::make([
            'cover_photo' => 'foo',
        ]),
        DeleteUserCoverPhotoRequest::class => MockResponse::make([], 201),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it will throw an exception if the file does not exist', function () {
    $this->connector->users()->profile_photo(1)->create('foobar');
})->throws(SaloonException::class);

test('it can get set the users cover photo', function () {
    $response = $this->connector->users()->cover_photo(1)->create(dirname(__FILE__).'/image.png');

    $data = $response->json();

    /** @var HasBody $request */
    $request = $response->getRequest();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($request->body()->all())->toContainOnlyInstancesOf(MultipartValue::class)
        ->and($request->body()->all())->toBeArray()
        ->and($data)->toEqual([
            'cover_photo' => 'foo',
        ]);

    $this->mockClient->assertSent(CreateUserCoverPhotoRequest::class);
});

test('it can delete a users cover photo', function () {
    $response = $this->connector->users()->cover_photo(1)->delete();

    $data = $response->json();

    expect($response->status())->toEqual(201)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteUserCoverPhotoRequest
            && $request->relationId === 1;
    });
});
