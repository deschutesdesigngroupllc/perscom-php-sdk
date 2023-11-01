<?php

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateStatusRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'statuses';
    }
}
