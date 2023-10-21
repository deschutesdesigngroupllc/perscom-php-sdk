<?php

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateGroupRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'groups';
    }
}
