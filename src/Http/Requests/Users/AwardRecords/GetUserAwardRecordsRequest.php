<?php

namespace Perscom\Http\Requests\Users\AwardRecords;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUserAwardRecordsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $userId
     */
    public function __construct(public int $userId)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "users/{$this->userId}/award-records";
    }
}
