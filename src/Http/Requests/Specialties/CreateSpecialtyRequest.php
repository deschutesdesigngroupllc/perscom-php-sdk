<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateSpecialtyRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'specialties';
    }
}
