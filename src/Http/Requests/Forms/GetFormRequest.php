<?php

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractGetRequest;

class GetFormRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'forms';
    }
}
