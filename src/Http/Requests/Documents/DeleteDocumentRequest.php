<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Documents;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteDocumentRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'documents';
    }
}
