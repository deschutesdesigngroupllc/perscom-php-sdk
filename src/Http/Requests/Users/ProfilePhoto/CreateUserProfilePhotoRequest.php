<?php

namespace Perscom\Http\Requests\Users\ProfilePhoto;

use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Exceptions\SaloonException;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class CreateUserProfilePhotoRequest extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    /**
     * @param int $relationId
     * @param string $filePath
     */
    public function __construct(public int $relationId, public string $filePath)
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
     * @return array<MultipartValue>
     * @throws SaloonException
     */
    protected function defaultBody(): array
    {
        if (! file_exists($this->filePath)) {
            throw new SaloonException('The specified file does not exist.');
        }

        return [
            new MultipartValue(name: 'profile_photo', value: file_get_contents($this->filePath), filename: pathinfo($this->filePath, PATHINFO_BASENAME)),
            new MultipartValue(name: '_method', value: 'put'),
        ];
    }
}
