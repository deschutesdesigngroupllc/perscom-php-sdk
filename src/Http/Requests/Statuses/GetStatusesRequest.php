<?php

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetStatusesRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'statuses';
    }
}
