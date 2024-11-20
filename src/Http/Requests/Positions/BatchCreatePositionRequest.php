<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreatePositionRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'positions';
    }
}
