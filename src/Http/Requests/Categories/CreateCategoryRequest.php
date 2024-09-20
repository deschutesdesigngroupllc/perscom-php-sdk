<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Categories;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateCategoryRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'categories';
    }
}
