<?php

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteGroupRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'groups';
    }
}
