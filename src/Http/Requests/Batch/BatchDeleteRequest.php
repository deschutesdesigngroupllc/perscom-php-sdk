<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Batch;

use Illuminate\Support\Arr;
use Perscom\Data\ResourceObject;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class BatchDeleteRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::DELETE;

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     */
    public function __construct(
        public string $resource,
        public ResourceObject|array $data
    ) {
        $this->data = Arr::wrap($this->data);
    }

    public function resolveEndpoint(): string
    {
        return "{$this->resource}/batch";
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return [
            'resources' => collect($this->data)->map(fn (ResourceObject $object) => $object->id)->toArray(),
        ];
    }
}
