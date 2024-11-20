<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteUnitRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'units';
    }
}
