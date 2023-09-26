<?php

namespace Perscom\Http\Requests\Forms;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteFormRequest extends Request
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
        return "forms/{$this->id}";
    }
}
