<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeletePositionRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'positions';
    }
}
