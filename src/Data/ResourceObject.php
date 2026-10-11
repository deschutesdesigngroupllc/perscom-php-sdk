<?php

declare(strict_types=1);

namespace Perscom\Data;

use Illuminate\Contracts\Support\Arrayable;
use Override;

/**
 * @implements Arrayable<array-key, mixed>
 */
final class ResourceObject implements Arrayable
{
    /**
     * @param  int|null  $id  The ID of the resource. Leave blank when creating a new resource.
     * @param  array<string, mixed>  $data  The resource's data.
     */
    public function __construct(
        public ?int $id = null,
        public array $data = [],
    ) {
        //
    }

    /**
     * @return array<array-key, mixed>
     */
    #[Override]
    public function toArray(): array
    {
        if (filled($this->id)) {
            return [
                (string) $this->id => $this->data,
            ];
        }

        return $this->data;
    }
}
