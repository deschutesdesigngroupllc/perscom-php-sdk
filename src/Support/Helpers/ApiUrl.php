<?php

declare(strict_types=1);

namespace Perscom\Support\Helpers;

use Perscom\PerscomConnection;

final class ApiUrl
{
    public static function withoutApiVersion(callable $callback)
    {
        $baseUrl = parse_url(PerscomConnection::$apiUrl);

        return $callback($baseUrl['scheme'].'://'.$baseUrl['host']);
    }
}
