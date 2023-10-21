<?php

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateFormRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'forms';
    }
}
