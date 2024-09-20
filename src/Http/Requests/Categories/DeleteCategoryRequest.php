<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Categories;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteCategoryRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'categories';
    }
}
