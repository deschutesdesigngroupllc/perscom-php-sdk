<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdatePositionRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'positions';
    }
}
