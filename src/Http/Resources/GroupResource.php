<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\SortObject;
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
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetGroupsRequest($include, $page, $limit));
    }

    /**
     * @param string|null $value
     * @param SortObject|array<SortObject>|null $sort
     * @param FilterObject|array<FilterObject>|null $filter
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
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
        return $this->connector->send(new SearchGroupsRequest($value, $sort, $filter, $include, $page, $limit));
    }

    /**
     * @param int $id
     * @param string|array<string> $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetGroupRequest($id, $include));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateGroupRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed> $data
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
