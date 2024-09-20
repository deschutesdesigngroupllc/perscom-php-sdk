<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractGetRequest;

class GetPositionRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'positions';
    }
}
