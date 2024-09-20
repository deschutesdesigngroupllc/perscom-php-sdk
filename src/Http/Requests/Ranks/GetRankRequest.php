<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractGetRequest;

class GetRankRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'ranks';
    }
}
