<?php

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetFormsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'forms';
    }
}
