<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Images;

use Perscom\Http\Requests\AbstractGetRequest;

class GetImageRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'images';
    }
}
