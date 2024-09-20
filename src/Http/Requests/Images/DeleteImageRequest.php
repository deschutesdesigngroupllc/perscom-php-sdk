<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Images;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteImageRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'images';
    }
}
