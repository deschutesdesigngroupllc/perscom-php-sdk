<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteGroupRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'groups';
    }
}
