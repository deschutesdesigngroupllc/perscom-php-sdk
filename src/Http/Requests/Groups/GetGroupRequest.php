<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractGetRequest;

class GetGroupRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'groups';
    }
}
