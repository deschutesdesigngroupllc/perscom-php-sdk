<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchSpecialtiesRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'specialties';
    }
}
