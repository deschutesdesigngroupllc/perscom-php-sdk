<?php

namespace Perscom\Http\Requests\Awards;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteAwardRequest extends Request
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
        return "awards/{$this->id}";
    }
}
