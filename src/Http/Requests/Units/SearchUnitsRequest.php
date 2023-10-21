<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Units;

use Perscom\RequestType\AbstractSearchRequest;

class SearchUnitsRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'units';
    }
}
