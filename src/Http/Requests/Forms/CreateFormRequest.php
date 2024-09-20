<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateFormRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'forms';
    }
}
