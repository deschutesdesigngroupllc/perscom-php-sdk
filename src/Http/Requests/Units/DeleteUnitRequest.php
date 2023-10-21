<?php

namespace Perscom\Http\Requests\Units;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteUnitRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'units';
    }
}
