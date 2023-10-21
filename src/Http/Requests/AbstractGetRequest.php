<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractGetRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $id
     * @param array<string> $include
     */
    public function __construct(public int $id, public array $include = [])
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "{$this->getResource()}/$this->id";
    }

    /**
     * @return string
     */
    abstract protected function getResource(): string;

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        return [
            'include' => implode(',', $this->include),
        ];
    }
}
