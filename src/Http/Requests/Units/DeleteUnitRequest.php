<?php

namespace Perscom\Http\Requests\Units;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteUnitRequest extends Request
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
        return "units/{$this->id}";
    }
}
