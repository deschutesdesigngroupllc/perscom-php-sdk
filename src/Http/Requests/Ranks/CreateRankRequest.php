<?php

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateRankRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'ranks';
    }
}
