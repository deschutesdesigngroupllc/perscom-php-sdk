<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Images;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateImageRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'images';
    }
}
