<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateRankRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'ranks';
    }
}
