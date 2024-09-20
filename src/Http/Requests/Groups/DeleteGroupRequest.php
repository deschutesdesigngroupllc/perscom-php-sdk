<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Groups;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteGroupRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'groups';
    }
}
