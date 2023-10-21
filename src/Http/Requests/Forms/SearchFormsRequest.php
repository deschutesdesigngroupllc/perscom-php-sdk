<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Forms;

use Perscom\RequestType\AbstractSearchRequest;

class SearchFormsRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'forms';
    }
}
