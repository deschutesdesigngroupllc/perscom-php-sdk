<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteSpecialtyRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'specialties';
    }
}
