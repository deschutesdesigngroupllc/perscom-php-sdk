<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateStatusRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'statuses';
    }
}
