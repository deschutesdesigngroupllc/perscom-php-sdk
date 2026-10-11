<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Multipart;

use Illuminate\Support\Collection;
use Override;
use Psr\Http\Message\StreamInterface;
use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class CreateMultipartRequest extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        public string $resource,
        public array $data
    ) {
        //
    }

    #[Override]
    public function resolveEndpoint(): string
    {
        return $this->resource;
    }

    /**
     * @return MultipartValue[]
     */
    protected function defaultBody(): array
    {
        /** @var Collection<string, mixed> $data */
        $data = collect($this->data);

        return $data->map(function (mixed $value, string $key): MultipartValue {
            /** @var StreamInterface|resource|string|int $value */
            return new MultipartValue(
                name: $key,
                value: $value
            );
        })->all();
    }
}
