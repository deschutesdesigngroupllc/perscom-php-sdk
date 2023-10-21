<?php

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetGroupsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'groups';
    }
}
