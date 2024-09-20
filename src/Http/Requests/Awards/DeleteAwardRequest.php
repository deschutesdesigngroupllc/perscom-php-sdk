<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Awards;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteAwardRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'awards';
    }
}
