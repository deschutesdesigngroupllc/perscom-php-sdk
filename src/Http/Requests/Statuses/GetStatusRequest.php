<?php

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractGetRequest;

class GetStatusRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'statuses';
    }
}
