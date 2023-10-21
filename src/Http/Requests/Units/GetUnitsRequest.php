<?php

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetUnitsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'units';
    }
}
