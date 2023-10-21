<?php

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateUnitRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'units';
    }
}
