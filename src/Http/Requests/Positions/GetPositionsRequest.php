<?php

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetPositionsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'positions';
    }
}
