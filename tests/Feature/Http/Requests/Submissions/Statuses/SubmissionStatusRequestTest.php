<?php

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Submissions\Statuses\AttachSubmissionStatusRequest;
use Perscom\PerscomConnection;
use Saloon\Contracts\Response;
use Saloon\Helpers\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
   Config::preventStrayRequests();

   $this->mockClient = new MockClient([
       AttachSubmissionStatusRequest::class => MockResponse::make([
           'attached' => [1]
       ])
   ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can attach a status', function () {
    $resource = new ResourceObject(1, ['text' => 'Test status.']);
    $response = $this->connector->submissions()->statuses(1)->attach($resource, 'record');

    $data = $response->json();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class)
        ->and($data)->toEqual([
            'attached' => [1]
        ]);

    $this->mockClient->assertSent(AttachSubmissionStatusRequest::class);
});
