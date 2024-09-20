<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetUnitsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'units';
    }
}
