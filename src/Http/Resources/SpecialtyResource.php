<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Specialties\CreateSpecialtyRequest;
use Perscom\Http\Requests\Specialties\DeleteSpecialtyRequest;
use Perscom\Http\Requests\Specialties\GetSpecialtyRequest;
use Perscom\Http\Requests\Specialties\GetSpecialtiesRequest;
use Perscom\Http\Requests\Specialties\SearchSpecialtiesRequest;
use Perscom\Http\Requests\Specialties\UpdateSpecialtyRequest;
use Saloon\Contracts\Response;

class SpecialtyResource extends Resource implements ResourceContract
{
    /**
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetSpecialtiesRequest($page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function search(array $data): Response
    {
        return $this->connector->send(new SearchSpecialtiesRequest($data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function get(int $id): Response
    {
        return $this->connector->send(new GetSpecialtyRequest($id));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateSpecialtyRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateSpecialtyRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteSpecialtyRequest($id));
    }
}
