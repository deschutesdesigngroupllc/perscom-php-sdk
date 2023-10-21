<?php

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateAwardRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'awards';
    }
}
