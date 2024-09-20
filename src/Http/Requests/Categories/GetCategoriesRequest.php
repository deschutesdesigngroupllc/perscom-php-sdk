<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Categories;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetCategoriesRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'categories';
    }
}
