<?php

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractGetRequest;

class GetUnitRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'units';
    }
}
