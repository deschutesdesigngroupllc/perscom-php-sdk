<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateStatusRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'statuses';
    }
}
