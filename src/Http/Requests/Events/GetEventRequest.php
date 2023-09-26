<?php

namespace Perscom\Http\Requests\Events;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetEventRequest extends Request
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
        return "events/{$this->id}";
    }
}
