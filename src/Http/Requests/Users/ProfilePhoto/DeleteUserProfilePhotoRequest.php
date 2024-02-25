<?php

namespace Perscom\Http\Requests\Users\ProfilePhoto;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class DeleteUserProfilePhotoRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * @param  int  $relationId
     */
    public function __construct(public int $relationId)
    {
        //
    }

    /**
     * @return string
     */
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
