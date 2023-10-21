<?php

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractGetRequest;

class GetGroupRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'groups';
    }
}
