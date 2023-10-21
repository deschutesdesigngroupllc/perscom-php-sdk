<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Groups\CreateGroupRequest;
use Perscom\Http\Requests\Groups\DeleteGroupRequest;
use Perscom\Http\Requests\Groups\GetGroupRequest;
use Perscom\Http\Requests\Groups\GetGroupsRequest;
use Perscom\Http\Requests\Groups\SearchGroupsRequest;
use Perscom\Http\Requests\Groups\UpdateGroupRequest;
use Saloon\Contracts\Response;

class GroupResource extends Resource implements ResourceContract
{
    /**
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetGroupsRequest($page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function search(array $data): Response
    {
        return $this->connector->send(new SearchGroupsRequest($data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function get(int $id): Response
    {
        return $this->connector->send(new GetGroupRequest($id));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateGroupRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateGroupRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteGroupRequest($id));
    }
}
