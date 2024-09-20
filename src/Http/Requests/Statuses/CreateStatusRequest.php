<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateStatusRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'statuses';
    }
}
