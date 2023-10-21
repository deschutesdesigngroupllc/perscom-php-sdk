<?php

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateRankRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'ranks';
    }
}
