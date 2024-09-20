<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateUnitRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'units';
    }
}
