<?php

declare(strict_types=1);

namespace Perscom\Data;

use Illuminate\Contracts\Support\Arrayable;

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
     * @return array<string, array>|array<int, mixed>
     */
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
