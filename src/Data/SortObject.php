<?php

namespace Perscom\Data;

use Saloon\Contracts\Arrayable;

class SortObject implements Arrayable
{
    /**
     * @param  string  $field
     * @param  string  $direction The supported directions are 'asc' and 'desc'.
     */
    public function __construct(public string $field, public string $direction = 'asc')
    {
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
