<?php

namespace Perscom\Http\Requests\Qualifications;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteQualificationRequest extends Request
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
        return "qualifications/{$this->id}";
    }
}
