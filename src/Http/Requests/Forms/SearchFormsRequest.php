<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchFormsRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'forms';
    }
}
