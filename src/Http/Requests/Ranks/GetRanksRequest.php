<?php

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetRanksRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'ranks';
    }
}
