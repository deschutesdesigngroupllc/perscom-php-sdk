<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Images;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateImageRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'images';
    }
}
