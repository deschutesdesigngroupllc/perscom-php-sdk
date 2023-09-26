<?php

namespace Perscom\Http\Requests\Users\AwardRecords;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteUserAwardRecordRequest extends Request
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
        return "users/{$this->userId}/award-records/{$this->id}";
    }
}
