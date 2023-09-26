<?php

namespace Perscom\Http\Requests\Tasks;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteTaskRequest extends Request
{
    protected Method $method = Method::DELETE;

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