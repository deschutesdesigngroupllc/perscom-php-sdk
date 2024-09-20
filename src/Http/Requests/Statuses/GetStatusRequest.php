<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractGetRequest;

class GetStatusRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'statuses';
    }
}
