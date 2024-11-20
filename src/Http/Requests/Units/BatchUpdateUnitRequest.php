<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateUnitRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'units';
    }
}
