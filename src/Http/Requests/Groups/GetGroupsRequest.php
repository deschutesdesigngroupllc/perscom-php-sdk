<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetGroupsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'groups';
    }
}
