<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateAwardRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'awards';
    }
}
