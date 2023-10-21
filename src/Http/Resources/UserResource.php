<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Users\CreateUserRequest;
use Perscom\Http\Requests\Users\DeleteUserRequest;
use Perscom\Http\Requests\Users\GetUserRequest;
use Perscom\Http\Requests\Users\GetUsersRequest;
use Perscom\Http\Requests\Users\SearchUsersRequest;
use Perscom\Http\Requests\Users\UpdateUserRequest;
use Saloon\Contracts\Response;

class UserResource extends Resource implements ResourceContract
{
    /**
     * @param array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetUsersRequest($include, $page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function search(array $data): Response
    {
        return $this->connector->send(new SearchUsersRequest($data));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetUserRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserRequest($id));
    }
}
