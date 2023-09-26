<?php

namespace Perscom\Http\Requests\Awards;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetAwardRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $id
     */
    public function __construct(public int $id)
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
