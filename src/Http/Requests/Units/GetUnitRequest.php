<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractGetRequest;

class GetUnitRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'units';
    }
}
