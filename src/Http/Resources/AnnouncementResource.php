<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Announcements\CreateAnnouncementRequest;
use Perscom\Http\Requests\Announcements\DeleteAnnouncementRequest;
use Perscom\Http\Requests\Announcements\GetAnnouncementRequest;
use Perscom\Http\Requests\Announcements\GetAnnouncementsRequest;
use Perscom\Http\Requests\Announcements\SearchAnnouncementsRequest;
use Perscom\Http\Requests\Announcements\UpdateAnnouncementRequest;
use Saloon\Contracts\Response;

class AnnouncementResource extends Resource implements ResourceContract
{
    /**
     * @param  string|array<string>  $include
     * @param  int  $page
     * @param  int  $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetAnnouncementsRequest($include, $page, $limit));
    }

    /**
     * @param  string|null  $value
     * @param  SortObject|array<SortObject>|null  $sort
     * @param  FilterObject|array<FilterObject>|null  $filter
     * @param  string|array<string>  $include
     * @param  int  $page
     * @param  int  $limit
     * @return Response
     */
    public function search(
        ?string $value = null,
        mixed $sort = null,
        mixed $filter = null,
        string|array $include = [],
        int $page = 1,
        int $limit = 20,
    ): Response {
        return $this->connector->send(new SearchAnnouncementsRequest($value, $sort, $filter, $include, $page, $limit));
    }

    /**
     * @param  int  $id
     * @param  string|array<string>  $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetAnnouncementRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateAnnouncementRequest($data));
    }

    /**
     * @param  int  $id
     * @param  array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateAnnouncementRequest($id, $data));
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteAnnouncementRequest($id));
    }
}
