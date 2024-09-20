<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetAwardsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'awards';
    }
}
