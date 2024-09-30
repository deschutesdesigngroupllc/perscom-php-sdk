<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Illuminate\Support\Arr;
use Perscom\Data\ResourceObject;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

abstract class AbstractBatchUpdateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     */
    public function __construct(public ResourceObject|array $data)
    {
        $this->data = Arr::wrap($this->data);
    }

    abstract protected function getResource(): string;

    public function resolveEndpoint(): string
    {
        return "{$this->getResource()}/batch";
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return [
            'resources' => collect($this->data)->mapWithKeys(function (ResourceObject $object) {
                return [
                    $object->id => $object->data,
                ];
            }),
        ];
    }
}
