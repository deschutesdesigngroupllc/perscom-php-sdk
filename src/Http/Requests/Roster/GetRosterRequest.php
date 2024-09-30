<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Roster;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetRosterRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'roster';
    }
}
