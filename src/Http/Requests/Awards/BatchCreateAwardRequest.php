<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateAwardRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'awards';
    }
}
