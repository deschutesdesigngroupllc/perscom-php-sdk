<?php

declare(strict_types=1);

namespace Perscom\Traits;

use Perscom\Http\Requests\Common\CreateImageRequest;
use Perscom\Http\Requests\Common\GetImageRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

/**
 * @mixin Resource
 */
trait HasImage
{
    abstract public function getResource(): string;

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function imageCreate(int $id, array $data): Response
    {
        return $this->connector->send(new CreateImageRequest(
            resource: $this->getResource(),
            id: $id,
            data: $data
        ));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function imageGet(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetImageRequest(
            resource: $this->getResource(),
            id: $id,
            include: $include
        ));
    }
}
