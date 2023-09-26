<?php

namespace Perscom\Http\Requests\Submissions;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetSubmissionRequest extends Request
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
        return "submissions/{$this->id}";
    }
}
