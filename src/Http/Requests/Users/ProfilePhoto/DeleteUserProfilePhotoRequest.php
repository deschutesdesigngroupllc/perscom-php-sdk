<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\ProfilePhoto;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class DeleteUserProfilePhotoRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(public int $relationId)
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return "users/$this->relationId";
    }

    /**
     * @return array<string, null>
     */
    protected function defaultBody(): array
    {
        return [
            'profile_photo' => null,
        ];
    }
}
