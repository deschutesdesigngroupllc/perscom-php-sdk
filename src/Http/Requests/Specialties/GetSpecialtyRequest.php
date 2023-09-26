<?php

namespace Perscom\Http\Requests\Specialties;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetSpecialtyRequest extends Request
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
        return "specialtys/{$this->id}";
    }
}
