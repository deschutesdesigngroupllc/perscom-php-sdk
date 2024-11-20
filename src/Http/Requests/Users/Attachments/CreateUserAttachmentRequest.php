<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\Attachments;

use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class CreateUserAttachmentRequest extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    public function __construct(public int $relationId, public array $data)
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return "users/$this->relationId/attachments";
    }

    /**
     * @return MultipartValue[]
     */
    protected function defaultBody(): array
    {
        return collect($this->data)->map(fn ($value, $key) => new MultipartValue(
            name: $key,
            value: $value
        ))->toArray();
    }
}
