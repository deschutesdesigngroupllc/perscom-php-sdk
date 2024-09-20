<?php

declare(strict_types=1);

namespace Perscom\Contracts;

use Saloon\Http\Response;

interface ResourceContract
{
    /**
     * @param  string|array<string>  $include
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response;

    /**
     * @param  string|array<string>  $include
     */
    public function get(int $id, string|array $include = []): Response;

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Response;

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): Response;

    public function delete(int $id): Response;
}
