<?php

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteStatusRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'statuses';
    }
}
