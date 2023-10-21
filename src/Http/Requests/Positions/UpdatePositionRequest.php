<?php

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdatePositionRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'positions';
    }
}
