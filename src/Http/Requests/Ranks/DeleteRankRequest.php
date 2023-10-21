<?php

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteRankRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'ranks';
    }
}
