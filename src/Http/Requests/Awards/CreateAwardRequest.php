<?php

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateAwardRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'awards';
    }
}
