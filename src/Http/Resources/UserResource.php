<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Users\CreateUserRequest;
use Perscom\Http\Requests\Users\DeleteUserRequest;
use Perscom\Http\Requests\Users\GetUserRequest;
use Perscom\Http\Requests\Users\GetUsersRequest;
use Saloon\Contracts\Response;

class UserResource extends Resource implements ResourceContract
{
    public function all(int $page = 1): Response
    {
        return $this->connector->send(new GetUsersRequest($page));
    }

    public function get(int $id): Response
    {
        return $this->connector->send(new GetUserRequest($id));
    }

    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserRequest($data));
    }

    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new CreateUserRequest($id, $data));
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserRequest($id));
    }
}
