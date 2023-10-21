<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Ranks\CreateRankRequest;
use Perscom\Http\Requests\Ranks\DeleteRankRequest;
use Perscom\Http\Requests\Ranks\GetRankRequest;
use Perscom\Http\Requests\Ranks\GetRanksRequest;
use Perscom\Http\Requests\Ranks\SearchRanksRequest;
use Perscom\Http\Requests\Ranks\UpdateRankRequest;
use Saloon\Contracts\Response;

class RankResource extends Resource implements ResourceContract
{
    /**
     * @param array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetRanksRequest($include, $page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function search(array $data): Response
    {
        return $this->connector->send(new SearchRanksRequest($data));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetRankRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateRankRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateRankRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteRankRequest($id));
    }
}
