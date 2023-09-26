<?php

namespace Perscom\Contracts;

use Saloon\Contracts\Response;

interface ResourceContract
{
    public function all(int $page): Response;

    public function get(int $id): Response;

    public function create(array $data): Response;

    public function update(int $id, array $data): Response;

    public function delete(int $id): Response;
}