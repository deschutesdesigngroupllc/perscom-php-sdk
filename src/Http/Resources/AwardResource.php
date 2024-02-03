<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Awards\CreateAwardRequest;
use Perscom\Http\Requests\Awards\DeleteAwardRequest;
use Perscom\Http\Requests\Awards\GetAwardRequest;
use Perscom\Http\Requests\Awards\GetAwardsRequest;
use Perscom\Http\Requests\Awards\SearchAwardsRequest;
use Perscom\Http\Requests\Awards\UpdateAwardRequest;
use Saloon\Contracts\Response;

class AwardResource extends Resource implements ResourceContract
{
    /**
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetAwardsRequest($include, $page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @param string|array<string> $include
     * @return Response
     */
    public function search(array $data, string|array $include = []): Response
    {
        return $this->connector->send(new SearchAwardsRequest($data, $include));
    }

    /**
     * @param int $id
     * @param string|array<string> $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetAwardRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateAwardRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateAwardRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteAwardRequest($id));
    }
}
