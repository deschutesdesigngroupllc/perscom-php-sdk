<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Documents;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateDocumentRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    protected function getResource(): string
    {
        return 'documents';
    }
}
