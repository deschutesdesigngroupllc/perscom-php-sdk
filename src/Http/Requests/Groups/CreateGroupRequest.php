<?php

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateGroupRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'groups';
    }
}
