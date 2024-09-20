<?php

declare(strict_types=1);

namespace Perscom\Support;

use Composer\InstalledVersions;
use Exception;

final class Composer
{
    public static function getPerscomPackageVersion(string $packageName = 'deschutesdesigngroupllc/perscom-php-sdk'): ?string
    {
        try {
            return InstalledVersions::getVersion($packageName);
        } catch (Exception $exception) {
            return null;
        }
    }
}
