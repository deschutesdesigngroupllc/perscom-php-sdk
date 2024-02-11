<?php

namespace Perscom\Support;

class Composer
{
    /**
     * @param string $packageName
     * @return string|null
     */
    public static function getPerscomPackageVersion(string $packageName = 'deschutesdesigngroupllc/perscom-php-sdk'): ?string
    {
        $composerJson = json_decode(file_get_contents(__DIR__.'/../../vendor/composer/installed.json'), true);

        $package = collect(data_get($composerJson, 'packages'))->first(fn ($package) => data_get($package, 'name') === $packageName);

        return data_get($package, 'version_normalized');
    }
}
