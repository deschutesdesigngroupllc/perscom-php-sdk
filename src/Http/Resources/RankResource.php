<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Ranks\CreateRankRequest;
use Perscom\Http\Requests\Ranks\DeleteRankRequest;
use Perscom\Http\Requests\Ranks\GetRankRequest;
use Perscom\Http\Requests\Ranks\GetRanksRequest;
use Perscom\Http\Requests\Ranks\UpdateRankRequest;
use Saloon\Contracts\Response;

class RankResource extends Resource implements ResourceContract
{
    /**
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetRanksRequest($page, $limit));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function get(int $id): Response
    {
        return $this->connector->send(new GetRankRequest($id));
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
