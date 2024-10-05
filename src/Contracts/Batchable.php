<?php

declare(strict_types=1);

namespace Perscom\Contracts;

use Perscom\Data\ResourceObject;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

interface Batchable
{
    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchCreate(ResourceObject|array $data): Response;

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchUpdate(ResourceObject|array $data): Response;

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchDelete(ResourceObject|array $data): Response;
}
