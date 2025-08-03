<?php

declare(strict_types=1);

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Batch\BatchCreateRequest;
use Perscom\Http\Requests\Batch\BatchDeleteRequest;
use Perscom\Http\Requests\Batch\BatchUpdateRequest;
use Perscom\Http\Requests\Crud\CreateRequest;
use Perscom\Http\Requests\Crud\DeleteRequest;
use Perscom\Http\Requests\Crud\GetAllRequest;
use Perscom\Http\Requests\Crud\GetRequest;
use Perscom\Http\Requests\Crud\UpdateRequest;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\Http\Resources\Users\AssignmentRecordsResource;
use Perscom\Http\Resources\Users\AttachmentsResource;
use Perscom\Http\Resources\Users\AwardRecordsResource;
use Perscom\Http\Resources\Users\CombatRecordsResource;
use Perscom\Http\Resources\Users\CoverPhotoResource;
use Perscom\Http\Resources\Users\ProfilePhotoResource;
use Perscom\Http\Resources\Users\QualificationRecordsResource;
use Perscom\Http\Resources\Users\RankRecordsResource;
use Perscom\Http\Resources\Users\ServiceRecordsResource;
use Perscom\Http\Resources\Users\StatusResource;
use Perscom\Http\Resources\Users\TrainingRecordsResource;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetAllRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@example.com',
                ],
            ],
        ]),
        SearchRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@example.com',
                ],
            ],
        ]),
        GetRequest::class => MockResponse::make([
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]),
        CreateRequest::class => MockResponse::make([
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]),
        UpdateRequest::class => MockResponse::make([
            'id' => 1,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
        ]),
        DeleteRequest::class => MockResponse::make([], 204),
        BatchCreateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@example.com',
                ],
            ],
        ]),
        BatchUpdateRequest::class => MockResponse::make([
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                    'email' => 'jane.doe@example.com',
                ],
            ],
        ]),
        BatchDeleteRequest::class => MockResponse::make([
            'deleted' => [1],
        ]),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get all users', function () {
    $response = $this->connector->users()->all();

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@example.com',
                ],
            ],
        ]);

    $this->mockClient->assertSent(GetAllRequest::class);
});

test('it can search users', function () {
    $response = $this->connector->users()->search('test');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@example.com',
                ],
            ],
        ]);

    $this->mockClient->assertSent(SearchRequest::class);
});

test('it can get a user', function () {
    $response = $this->connector->users()->get(1);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof GetRequest
            && $request->id === 1;
    });
});

test('it can create a user', function () {
    $response = $this->connector->users()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof CreateRequest
            && $request->data['first_name'] === 'John'
            && $request->data['last_name'] === 'Doe'
            && $request->data['email'] === 'john.doe@example.com';
    });
});

test('it can update a user', function () {
    $response = $this->connector->users()->update(1, [
        'first_name' => 'Jane',
        'email' => 'jane.doe@example.com',
    ]);

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'id' => 1,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof UpdateRequest
            && $request->id === 1
            && $request->data['first_name'] === 'Jane'
            && $request->data['email'] === 'jane.doe@example.com';
    });
});

test('it can delete a user', function () {
    $response = $this->connector->users()->delete(1);

    $data = $response->json();

    expect($response->status())->toEqual(204)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof DeleteRequest
            && $request->id === 1;
    });
});

test('it can batch create users', function () {
    $response = $this->connector->users()->batchCreate(new ResourceObject(data: [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@example.com',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchCreateRequest
            && $request->resource === 'users';
    });
});

test('it can batch update users', function () {
    $response = $this->connector->users()->batchUpdate(new ResourceObject(1, [
        'first_name' => 'Jane',
        'email' => 'jane.doe@example.com',
    ]));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                    'email' => 'jane.doe@example.com',
                ],
            ],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchUpdateRequest
            && $request->resource === 'users';
    });
});

test('it can batch delete users', function () {
    $response = $this->connector->users()->batchDelete(new ResourceObject(1));

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'deleted' => [1],
        ]);

    $this->mockClient->assertSent(function (Request $request) {
        return $request instanceof BatchDeleteRequest
            && $request->resource === 'users';
    });
});

test('it can get user profile photo resource', function () {
    $resource = $this->connector->users()->profilePhoto(1);

    expect($resource)->toBeInstanceOf(ProfilePhotoResource::class);
});

test('it can get user cover photo resource', function () {
    $resource = $this->connector->users()->coverPhoto(1);

    expect($resource)->toBeInstanceOf(CoverPhotoResource::class);
});

test('it can get user attachments resource', function () {
    $resource = $this->connector->users()->attachments(1);

    expect($resource)->toBeInstanceOf(AttachmentsResource::class);
});

test('it can get user assignment records resource', function () {
    $resource = $this->connector->users()->assignmentRecords(1);

    expect($resource)->toBeInstanceOf(AssignmentRecordsResource::class);
});

test('it can get user award records resource', function () {
    $resource = $this->connector->users()->awardRecords(1);

    expect($resource)->toBeInstanceOf(AwardRecordsResource::class);
});

test('it can get user combat records resource', function () {
    $resource = $this->connector->users()->combatRecords(1);

    expect($resource)->toBeInstanceOf(CombatRecordsResource::class);
});

test('it can get user qualification records resource', function () {
    $resource = $this->connector->users()->qualificationRecords(1);

    expect($resource)->toBeInstanceOf(QualificationRecordsResource::class);
});

test('it can get user rank records resource', function () {
    $resource = $this->connector->users()->rankRecords(1);

    expect($resource)->toBeInstanceOf(RankRecordsResource::class);
});

test('it can get user service records resource', function () {
    $resource = $this->connector->users()->serviceRecords(1);

    expect($resource)->toBeInstanceOf(ServiceRecordsResource::class);
});

test('it can get user training records resource', function () {
    $resource = $this->connector->users()->trainingRecords(1);

    expect($resource)->toBeInstanceOf(TrainingRecordsResource::class);
});

test('it can get user statuses resource', function () {
    $resource = $this->connector->users()->statuses(1);

    expect($resource)->toBeInstanceOf(StatusResource::class);
});
