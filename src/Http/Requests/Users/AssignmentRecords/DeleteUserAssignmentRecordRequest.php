<?php

namespace Perscom\Http\Requests\Users\AssignmentRecords;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteUserAssignmentRecordRequest extends Request
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
        return "users/{$this->userId}/assignment-records/{$this->id}";
    }
}
