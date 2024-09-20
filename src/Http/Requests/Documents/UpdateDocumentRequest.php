<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Documents;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateDocumentRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'documents';
    }
}
