<?php

namespace Perscom\Support;

use Composer\InstalledVersions;
use Exception;

class Composer
{
    /**
     * @param string $packageName
     * @return string|null
     */
    public static function getPerscomPackageVersion(string $packageName = 'deschutesdesigngroupllc/perscom-php-sdk'): ?string
    {
        try {
            return InstalledVersions::getVersion($packageName);
        } catch (Exception $exception) {
            return null;
        }
    }
}
