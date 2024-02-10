<?php

namespace Perscom\Contracts;

use Saloon\Contracts\Response;

interface ResourceContract
{
    /**
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response;

    /**
     * @param int $id
     * @param string|array<string> $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response;

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function create(array $data): Response;

    /**
     * @param int $id
     * @param array<string, mixed> $data
     * @return Response
     */
    public function update(int $id, array $data): Response;

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response;
}
