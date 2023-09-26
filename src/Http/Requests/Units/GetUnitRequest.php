<?php

namespace Perscom\Http\Requests\Units;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUnitRequest extends Request
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
        return "units/{$this->id}";
    }
}
