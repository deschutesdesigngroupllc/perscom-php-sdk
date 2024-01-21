<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Positions\CreatePositionRequest;
use Perscom\Http\Requests\Positions\DeletePositionRequest;
use Perscom\Http\Requests\Positions\GetPositionRequest;
use Perscom\Http\Requests\Positions\GetPositionsRequest;
use Perscom\Http\Requests\Positions\SearchPositionsRequest;
use Perscom\Http\Requests\Positions\UpdatePositionRequest;
use Saloon\Contracts\Response;

class PositionResource extends Resource implements ResourceContract
{
    /**
     * @param array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetPositionsRequest($include, $page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @param array<string> $include
     * @return Response
     */
    public function search(array $data, array $include = []): Response
    {
        return $this->connector->send(new SearchPositionsRequest($data, $include));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetPositionRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreatePositionRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdatePositionRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeletePositionRequest($id));
    }
}
