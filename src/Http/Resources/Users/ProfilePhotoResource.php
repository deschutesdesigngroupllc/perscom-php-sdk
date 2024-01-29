<?php

namespace Perscom\Http\Resources\Users;

use Perscom\Http\Requests\Users\ProfilePhoto\CreateUserProfilePhotoRequest;
use Perscom\Http\Requests\Users\ProfilePhoto\DeleteUserProfilePhotoRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;

class ProfilePhotoResource extends Resource
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
        return $this->connector->send(new CreateUserProfilePhotoRequest($this->relationId, $filePath));
    }

    /**
     * @return Response
     */
    public function delete(): Response
    {
        return $this->connector->send(new DeleteUserProfilePhotoRequest($this->relationId));
    }
}
