<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

class RosterRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'roster';
    }
}
