<?php

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractGetRequest;

class GetRankRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'ranks';
    }
}
