<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Http\Requests\Newsfeed\GetNewsfeedRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class NewsfeedResource extends Resource
{
    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetNewsfeedRequest($include, $page, $limit));
    }
}
