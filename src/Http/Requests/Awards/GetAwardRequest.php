<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractGetRequest;

class GetAwardRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'awards';
    }
}
