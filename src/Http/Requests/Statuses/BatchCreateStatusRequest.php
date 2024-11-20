<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateStatusRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'statuses';
    }
}
