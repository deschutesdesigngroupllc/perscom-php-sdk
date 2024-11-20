<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeletePositionRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'positions';
    }
}
