<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Images;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchImagesRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'images';
    }
}
