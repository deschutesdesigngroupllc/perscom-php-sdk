<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractGetRequest;

class GetFormRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'forms';
    }
}
