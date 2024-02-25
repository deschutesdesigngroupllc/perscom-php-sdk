<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Users;

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Users\Statuses\AttachUserStatusRequest;
use Perscom\Http\Requests\Users\Statuses\DetachUserStatusRequest;
use Perscom\Http\Requests\Users\Statuses\SyncUserStatusRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;

class StatusResource extends Resource
{
    /**
     * @param  Connector  $connector
     * @param  int  $relationId
     */
    public function __construct(Connector $connector, protected int $relationId)
    {
        parent::__construct($connector);
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     * @param  bool  $allowDuplicates
     * @return Response
     */
    public function attach(ResourceObject|array $resources, string|array $include = [], bool $allowDuplicates = false): Response
    {
        return $this->connector->send(new AttachUserStatusRequest($this->relationId, $resources, $include, $allowDuplicates));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     * @return Response
     */
    public function detach(ResourceObject|array $resources, string|array $include = []): Response
    {
        return $this->connector->send(new DetachUserStatusRequest($this->relationId, $resources, $include));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     * @param  bool  $allowDetaching
     * @return Response
     */
    public function sync(ResourceObject|array $resources, string|array $include = [], bool $allowDetaching = true): Response
    {
        return $this->connector->send(new SyncUserStatusRequest($this->relationId, $resources, $include, $allowDetaching));
    }
}
