<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Competencies;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateCompetencyRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'competencies';
    }
}
