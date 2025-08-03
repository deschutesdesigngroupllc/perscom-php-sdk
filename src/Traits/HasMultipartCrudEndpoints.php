<?php

declare(strict_types=1);

namespace Perscom\Traits;

use Perscom\Http\Requests\Multipart\CreateMultipartRequest;
use Perscom\Http\Requests\Multipart\UpdateMultipartRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

/**
 * @mixin Resource
 */
trait HasMultipartCrudEndpoints
{
    abstract public function getResource(): string;

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateMultipartRequest(
            resource: $this->getResource(),
            data: $data
        ));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateMultipartRequest(
            resource: $this->getResource(),
            id: $id,
            data: $data
        ));
    }
}
