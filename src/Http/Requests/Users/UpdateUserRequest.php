<?php

namespace Perscom\Http\Requests\Users;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateUserRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected int $id, protected array $data)
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return "users/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }
}
