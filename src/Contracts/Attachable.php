<?php

declare(strict_types=1);

namespace Perscom\Contracts;

use Perscom\Data\ResourceObject;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

interface Attachable
{
    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     *
     * @throws RequestException|FatalRequestException
     */
    public function attach(ResourceObject|array $resources, string|array $include = [], bool $allowDuplicates = false): Response;

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     *
     * @throws RequestException|FatalRequestException
     */
    public function detach(ResourceObject|array $resources, string|array $include = []): Response;

    /**
     * @param  ResourceObject|array<ResourceObject>  $resources
     * @param  string|array<string>  $include
     *
     * @throws RequestException|FatalRequestException
     */
    public function sync(ResourceObject|array $resources, string|array $include = [], bool $allowDetaching = true): Response;
}
