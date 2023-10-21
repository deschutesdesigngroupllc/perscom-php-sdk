<?php

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteFormRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'forms';
    }
}
