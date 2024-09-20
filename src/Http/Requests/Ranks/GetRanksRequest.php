<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetRanksRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'ranks';
    }
}
