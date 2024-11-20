<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateGroupRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'groups';
    }
}
