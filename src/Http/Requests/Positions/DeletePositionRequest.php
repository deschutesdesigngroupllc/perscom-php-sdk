<?php

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeletePositionRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'positions';
    }
}
