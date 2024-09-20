<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Forms;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteFormRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'forms';
    }
}
