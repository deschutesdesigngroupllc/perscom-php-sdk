<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetFormsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'forms';
    }
}
