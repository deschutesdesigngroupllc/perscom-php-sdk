<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateAwardRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'awards';
    }
}
