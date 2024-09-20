<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Categories;

use Perscom\Http\Requests\AbstractGetRequest;

class GetCategoryRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'categories';
    }
}
