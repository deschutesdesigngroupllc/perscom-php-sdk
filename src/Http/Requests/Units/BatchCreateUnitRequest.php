<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateUnitRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'units';
    }
}
