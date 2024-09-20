<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetStatusesRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'statuses';
    }
}
