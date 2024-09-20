<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractDeleteRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(public int $id)
    {
        //
    }

    abstract protected function getResource(): string;

    public function resolveEndpoint(): string
    {
        return "{$this->getResource()}/$this->id";
    }
}
