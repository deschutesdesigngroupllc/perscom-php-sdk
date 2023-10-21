<?php

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateFormRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'forms';
    }
}
