<?php

namespace Perscom\Http\Resources\Users;

use Perscom\Http\Requests\Users\CoverPhoto\CreateUserCoverPhotoRequest;
use Perscom\Http\Requests\Users\CoverPhoto\DeleteUserCoverPhotoRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;

class CoverPhotoResource extends Resource
{
    /**
     * @param Connector $connector
     * @param int $relationId
     */
    public function __construct(protected Connector $connector, protected int $relationId)
    {
        parent::__construct($connector);
    }

    /**
     * @param string $filePath
     * @return Response
     */
    public function create(string $filePath): Response
    {
        return $this->connector->send(new CreateUserCoverPhotoRequest($this->relationId, $filePath));
    }

    /**
     * @return Response
     */
    public function delete(): Response
    {
        return $this->connector->send(new DeleteUserCoverPhotoRequest($this->relationId));
    }
}
