<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Calendars\CreateCalendarRequest;
use Perscom\Http\Requests\Calendars\DeleteCalendarRequest;
use Perscom\Http\Requests\Calendars\GetCalendarRequest;
use Perscom\Http\Requests\Calendars\GetCalendarsRequest;
use Perscom\Http\Requests\Calendars\SearchCalendarsRequest;
use Perscom\Http\Requests\Calendars\UpdateCalendarRequest;
use Saloon\Contracts\Response;

class CalendarResource extends Resource implements ResourceContract
{
    /**
     * @param array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetCalendarsRequest($include, $page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @param array<string> $include
     * @return Response
     */
    public function search(array $data, array $include = []): Response
    {
        return $this->connector->send(new SearchCalendarsRequest($data, $include));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetCalendarRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateCalendarRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateCalendarRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteCalendarRequest($id));
    }
}
