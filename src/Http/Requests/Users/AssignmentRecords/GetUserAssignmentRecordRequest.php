<?php

namespace Perscom\Http\Requests\Users\AssignmentRecords;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUserAssignmentRecordRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $userId
     * @param int $id
     */
    public function __construct(protected int $userId, protected int $id)
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