<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Competencies;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetCompetenciesRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'competencies';
    }
}
