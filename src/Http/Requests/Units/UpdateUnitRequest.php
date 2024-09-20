<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateUnitRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'units';
    }
}
