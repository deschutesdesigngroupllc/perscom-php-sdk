<?php

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateUnitRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'units';
    }
}
