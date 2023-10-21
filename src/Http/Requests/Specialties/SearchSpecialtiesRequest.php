<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\RequestType\AbstractSearchRequest;

class SearchSpecialtiesRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'specialtys';
    }
}
