<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Roster;

use Perscom\Http\Requests\AbstractGetRequest;

class GetRosterGroupRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'roster';
    }
}
