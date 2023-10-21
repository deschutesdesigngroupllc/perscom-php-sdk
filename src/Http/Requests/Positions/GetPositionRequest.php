<?php

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractGetRequest;

class GetPositionRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'positions';
    }
}
