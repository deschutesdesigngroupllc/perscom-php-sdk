<?php

namespace Perscom\Data;

use Saloon\Contracts\Arrayable;

class FilterObject implements Arrayable
{
    /**
     * @param string $field
     * @param string $operator The supported operators are '<', '<=', '>', '>=', '=', '!=', 'like', 'not like', 'in', 'not in'.
     * @param string $value
     * @param string $type The supported types are 'or' and 'and'. Defaults to OR.
     */
    public function __construct(public string $field, public string $operator, public string $value, public string $type = 'or')
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
            'operator' => $this->operator,
            'value' => $this->value,
            'type' => $this->type
        ];
    }
}
