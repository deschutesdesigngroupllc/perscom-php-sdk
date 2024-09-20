<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Documents;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetDocumentsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'documents';
    }
}
