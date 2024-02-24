<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Submissions;

use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\Submissions\Statuses\AttachSubmissionStatusRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;

class StatusResource extends Resource
{
    /**
     * @param Connector $connector
     * @param int $relationId
     */
    public function __construct(Connector $connector, protected int $relationId)
    {
        parent::__construct($connector);
    }

    /**
     * @param ResourceObject|array<ResourceObject> $resources
     * @param string|array<string> $include
     * @return Response
     */
    public function attach(ResourceObject|array $resources, string|array $include = []): Response
    {
        return $this->connector->send(new AttachSubmissionStatusRequest($this->relationId, $resources, $include));
    }
}
