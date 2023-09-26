<?php

namespace Perscom\Http\Requests\Qualifications;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetQualificationRequest extends Request
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
        return "qualifications/{$this->id}";
    }
}
