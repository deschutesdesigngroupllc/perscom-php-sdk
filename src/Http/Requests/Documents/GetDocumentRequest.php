<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Documents;

use Perscom\Http\Requests\AbstractGetRequest;

class GetDocumentRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'documents';
    }
}
