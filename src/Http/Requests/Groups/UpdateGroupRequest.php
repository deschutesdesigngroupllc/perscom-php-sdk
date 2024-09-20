<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateGroupRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'groups';
    }
}
