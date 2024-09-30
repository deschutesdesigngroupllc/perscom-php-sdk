
<?php

use Perscom\Http\Requests\Newsfeed\GetNewsfeedRequest;
use Perscom\PerscomConnection;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

beforeEach(function () {
    Config::preventStrayRequests();

    $this->mockClient = new MockClient([
        GetNewsfeedRequest::class => MockResponse::make(),
    ]);

    $this->connector = new PerscomConnection('foo', 'bar');
    $this->connector->withMockClient($this->mockClient);
});

test('it can get the newsfeed', function () {
    $response = $this->connector->newsfeed()->all();

    expect($response->status())->toEqual(200)
        ->and($response)->toBeInstanceOf(Response::class);

    $this->mockClient->assertSent(GetNewsfeedRequest::class);
});
