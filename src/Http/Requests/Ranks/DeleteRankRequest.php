<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Ranks;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteRankRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'ranks';
    }
}
