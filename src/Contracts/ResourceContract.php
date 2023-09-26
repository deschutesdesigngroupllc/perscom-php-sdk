<?php

namespace Perscom\Contracts;

use Saloon\Contracts\Response;

interface ResourceContract
{
    /**
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(int $page = 1, int $limit = 20): Response;

    /**
     * @param int $id
     * @return Response
     */
    public function get(int $id): Response;

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
