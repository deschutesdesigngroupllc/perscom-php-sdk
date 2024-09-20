<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateFormRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'forms';
    }
}
