<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteRankRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'ranks';
    }
}
