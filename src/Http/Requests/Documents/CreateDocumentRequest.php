<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Documents;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateDocumentRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'documents';
    }
}
