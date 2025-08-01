<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\ResourceContract;
use Perscom\Contracts\Searchable;
use Perscom\Http\Requests\Specialties\CreateSpecialtyRequest;
use Perscom\Http\Requests\Specialties\DeleteSpecialtyRequest;
use Perscom\Http\Requests\Specialties\GetSpecialtiesRequest;
use Perscom\Http\Requests\Specialties\GetSpecialtyRequest;
use Perscom\Http\Requests\Specialties\UpdateSpecialtyRequest;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class SpecialtyResource extends Resource implements Batchable, ResourceContract, Searchable
{
    use HasBatchEndpoints;
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'specialties';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetSpecialtiesRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetSpecialtyRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateSpecialtyRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateSpecialtyRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteSpecialtyRequest($id));
    }
}
