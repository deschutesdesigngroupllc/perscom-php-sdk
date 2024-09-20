<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateSpecialtyRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'specialties';
    }
}
