<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Positions;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdatePositionRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'positions';
    }
}
