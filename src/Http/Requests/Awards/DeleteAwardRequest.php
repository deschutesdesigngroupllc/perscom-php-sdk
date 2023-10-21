<?php

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteAwardRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'awards';
    }
}
