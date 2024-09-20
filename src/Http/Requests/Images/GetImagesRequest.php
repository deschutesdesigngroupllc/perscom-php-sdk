<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Images;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetImagesRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'images';
    }
}
