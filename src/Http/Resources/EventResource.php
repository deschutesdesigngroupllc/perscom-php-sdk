<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Events\CreateEventRequest;
use Perscom\Http\Requests\Events\DeleteEventRequest;
use Perscom\Http\Requests\Events\GetEventRequest;
use Perscom\Http\Requests\Events\GetEventsRequest;
use Perscom\Http\Requests\Events\SearchEventsRequest;
use Perscom\Http\Requests\Events\UpdateEventRequest;
use Saloon\Contracts\Response;

class EventResource extends Resource implements ResourceContract
{
    /**
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetEventsRequest($include, $page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @param array<string> $include
     * @return Response
     */
    public function search(array $data, array $include = []): Response
    {
        return $this->connector->send(new SearchEventsRequest($data, $include));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetEventRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateEventRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateEventRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteEventRequest($id));
    }
}
