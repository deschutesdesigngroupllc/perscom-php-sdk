<?php

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractGetRequest;

class GetAwardRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'awards';
    }
}
