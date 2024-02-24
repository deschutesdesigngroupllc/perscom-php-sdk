<?php

declare(strict_types=1);

namespace Perscom\Data;

use Saloon\Contracts\Arrayable;

class ResourceObject implements Arrayable
{
    /**
     * @param int $id
     * @param array $data
     */
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
            (string)$this->id => $this->data,
        ];
    }
}
