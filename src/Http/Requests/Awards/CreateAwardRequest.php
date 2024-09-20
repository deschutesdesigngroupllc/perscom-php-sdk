<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateAwardRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'awards';
    }
}
