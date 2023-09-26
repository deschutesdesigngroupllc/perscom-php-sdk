<?php

namespace Perscom\Http\Requests\Events;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteEventRequest extends Request
{
    protected Method $method = Method::DELETE;

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
        return "events/{$this->id}";
    }
}
