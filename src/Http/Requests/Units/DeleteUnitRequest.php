<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteUnitRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'units';
    }
}
