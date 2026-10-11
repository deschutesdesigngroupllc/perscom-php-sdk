<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Image;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Override;
use Psr\Http\Message\StreamInterface;
use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class UpdateImageRequest extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::PATCH;

    /**
     * @param  array<string, mixed>  $data
     * @param  string|array<string>  $include
     */
    public function __construct(public string $resource, public int $id, public array $data, public string|array $include = [])
    {
        $this->include = Arr::wrap($this->include);
    }

    #[Override]
    public function resolveEndpoint(): string
    {
        return sprintf('%s/%d/image', $this->resource, $this->id);
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

    /**
     * @return array<string, mixed>
     */
    #[Override]
    protected function defaultQuery(): array
    {
        $query = [];

        if (filled($this->include)) {
            $query['include'] = implode(',', (array) $this->include);
        }

        return $query;
    }
}
