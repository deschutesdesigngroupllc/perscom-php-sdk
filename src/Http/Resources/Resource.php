<?php

namespace Perscom\Http\Resources;

use Saloon\Contracts\Connector;

class Resource
{
    /**
     * @param Connector $connector
     */
    public function __construct(protected Connector $connector)
    {
        //
    }
}
