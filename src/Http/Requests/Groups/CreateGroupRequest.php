<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateGroupRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'groups';
    }
}
