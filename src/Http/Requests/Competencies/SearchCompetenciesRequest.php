<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Competencies;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchCompetenciesRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'competencies';
    }
}
