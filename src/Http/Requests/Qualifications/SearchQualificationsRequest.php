<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchQualificationsRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'qualifications';
    }
}
