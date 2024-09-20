<?php

declare(strict_types=1);

namespace Perscom\Data;

use Illuminate\Contracts\Support\Arrayable;

final class ResourceObject implements Arrayable
{
    public function __construct(
        public int $id,
        public array $data = [],
    ) {
        //
    }

    /**
     * @return array<string, array>
     */
    public function toArray(): array
    {
        return [
            (string) $this->id => $this->data,
        ];
    }
}
