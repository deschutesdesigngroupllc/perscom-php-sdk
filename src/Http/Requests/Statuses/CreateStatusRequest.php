<?php

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateStatusRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'statuses';
    }
}
