<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteAwardRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'awards';
    }
}
