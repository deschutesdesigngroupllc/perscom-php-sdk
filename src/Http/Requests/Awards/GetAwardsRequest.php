<?php

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetAwardsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'awards';
    }
}
