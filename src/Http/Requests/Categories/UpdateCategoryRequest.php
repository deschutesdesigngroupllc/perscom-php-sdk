<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Categories;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateCategoryRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'categories';
    }
}
