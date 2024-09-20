<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateRankRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'ranks';
    }
}
