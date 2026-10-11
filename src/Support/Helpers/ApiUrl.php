<?php

declare(strict_types=1);

namespace Perscom\Support\Helpers;

use Perscom\Exceptions\InvalidArgumentException;
use Perscom\PerscomConnection;

final class ApiUrl
{
    public static function withoutApiVersion(callable $callback): string
    {
        $baseUrl = parse_url(PerscomConnection::$apiUrl);

        if (! isset($baseUrl['scheme'], $baseUrl['host'])) {
            throw new InvalidArgumentException('The PERSCOM API URL must contain a scheme and host.');
        }

        return $callback($baseUrl['scheme'].'://'.$baseUrl['host']);
    }
}
