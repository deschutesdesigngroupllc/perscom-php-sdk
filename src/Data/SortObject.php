<?php

declare(strict_types=1);

namespace Perscom\Data;

use Illuminate\Contracts\Support\Arrayable;

final class SortObject implements Arrayable
{
    /**
     * @param  string  $field  The field to sort by.
     * @param  string  $direction  The supported directions are 'asc' and 'desc'.
     */
    public function __construct(
        public string $field,
        public string $direction = 'asc'
    ) {
        //
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'field' => $this->field,
            'direction' => $this->direction,
        ];
    }
}
