<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Statuses;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteStatusRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'statuses';
    }
}
