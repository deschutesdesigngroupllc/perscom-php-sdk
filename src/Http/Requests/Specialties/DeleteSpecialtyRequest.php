<?php

namespace Perscom\Http\Requests\Specialties;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteSpecialtyRequest extends Request
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
        return "specialtys/{$this->id}";
    }
}