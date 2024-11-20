<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateGroupRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'groups';
    }
}
