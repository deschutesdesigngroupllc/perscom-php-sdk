<?php

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreatePositionRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'positions';
    }
}
