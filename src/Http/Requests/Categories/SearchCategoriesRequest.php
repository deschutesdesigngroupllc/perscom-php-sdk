<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Categories;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchCategoriesRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'categories';
    }
}
