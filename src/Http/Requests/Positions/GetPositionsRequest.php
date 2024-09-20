<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetPositionsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'positions';
    }
}
