<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchPositionsRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'positions';
    }
}
