<?php

declare(strict_types=1);

namespace Perscom\Traits;

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Attach\AttachRequest;
use Perscom\Http\Requests\Attach\DetachRequest;
use Perscom\Http\Requests\Attach\SyncRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

/**
 * @mixin Resource
 */
trait HasAttachEndpoints
{
    abstract public function getResource(): string;

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     *
     * @throws RequestException|FatalRequestException
     */
    public function attach(ResourceObject|array $resources, string|array $include = [], bool $allowDuplicates = false): Response
    {
        return $this->connector->send(new AttachRequest(
            resource: $this->getResource(),
            resources: $resources,
            include: $include,
            allowDuplicates: $allowDuplicates
        ));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     *
     * @throws RequestException|FatalRequestException
     */
    public function detach(ResourceObject|array $resources, string|array $include = []): Response
    {
        return $this->connector->send(new DetachRequest(
            resource: $this->getResource(),
            resources: $resources,
            include: $include
        ));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     *
     * @throws RequestException|FatalRequestException
     */
    public function sync(ResourceObject|array $resources, string|array $include = [], bool $allowDetaching = true): Response
    {
        return $this->connector->send(new SyncRequest(
            resource: $this->getResource(),
            resources: $resources,
            include: $include,
            allowDetaching: $allowDetaching
        ));
    }
}
