<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreatePositionRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'positions';
    }
}
