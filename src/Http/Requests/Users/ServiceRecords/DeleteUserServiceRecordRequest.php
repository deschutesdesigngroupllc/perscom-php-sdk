<?php

namespace Perscom\Http\Requests\Users\ServiceRecords;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteUserServiceRecordRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * @param int $userId
     * @param int $id
     */
    public function __construct(public int $userId, public int $id)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "users/{$this->userId}/service-records/{$this->id}";
    }
}
