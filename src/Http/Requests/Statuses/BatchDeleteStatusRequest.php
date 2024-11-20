<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteStatusRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'statuses';
    }
}
