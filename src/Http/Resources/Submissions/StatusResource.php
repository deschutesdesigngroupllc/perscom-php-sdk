<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Submissions;

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Submissions\Statuses\AttachSubmissionStatusRequest;
use Perscom\Http\Requests\Submissions\Statuses\DetachSubmissionStatusRequest;
use Perscom\Http\Requests\Submissions\Statuses\SyncSubmissionStatusRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class StatusResource extends Resource
{
    public function __construct(Connector $connector, protected int $relationId)
    {
        parent::__construct($connector);
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     */
    public function attach(ResourceObject|array $resources, string|array $include = [], bool $allowDuplicates = false): Response
    {
        return $this->connector->send(new AttachSubmissionStatusRequest($this->relationId, $resources, $include, $allowDuplicates));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     */
    public function detach(ResourceObject|array $resources, string|array $include = []): Response
    {
        return $this->connector->send(new DetachSubmissionStatusRequest($this->relationId, $resources, $include));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     */
    public function sync(ResourceObject|array $resources, string|array $include = [], bool $allowDetaching = true): Response
    {
        return $this->connector->send(new SyncSubmissionStatusRequest($this->relationId, $resources, $include, $allowDetaching));
    }
}
