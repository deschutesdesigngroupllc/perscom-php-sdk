<?php

namespace Perscom\Http\Requests\Tasks;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetTaskRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $id
     */
    public function __construct(protected int $id)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "tasks/{$this->id}";
    }
}
