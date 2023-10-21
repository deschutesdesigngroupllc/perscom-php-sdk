<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
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
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetAnnouncementsRequest($page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function search(array $data): Response
    {
        return $this->connector->send(new SearchAnnouncementsRequest($data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function get(int $id): Response
    {
        return $this->connector->send(new GetAnnouncementRequest($id));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateAnnouncementRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateAnnouncementRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteAnnouncementRequest($id));
    }
}
