<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateRankRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'ranks';
    }
}
