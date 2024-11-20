<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateRankRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'ranks';
    }
}
