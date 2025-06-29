<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Common;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
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

    public function resolveEndpoint(): string
    {
        return "$this->resource/$this->id/image";
    }

    /**
     * @return MultipartValue[]
     */
    protected function defaultBody(): array
    {
        /** @var Collection<string, mixed> $data */
        $data = collect($this->data);

        return $data->map(fn (mixed $value, string $key): MultipartValue => new MultipartValue(
            name: $key,
            value: $value
        ))->toArray();
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        $query = [];

        if (filled($this->include)) {
            $query['include'] = implode(',', $this->include);
        }

        return $query;
    }
}
