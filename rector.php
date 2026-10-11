<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use RectorLaravel\Set\LaravelSetList;

return RectorConfig::configure()
    ->withCache(
        cacheDirectory: __DIR__.'/.rector.cache',
    )
    ->withPaths([
        __DIR__.'/src',
    ])
    ->withSkip([
        StringClassNameToClassConstantRector::class,
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        earlyReturn: true,
        carbon: true,
    )
    ->withImportNames(
        importDocBlockNames: false,
        removeUnusedImports: true,
    )
    ->withPhpSets()
    ->withSets([
        LaravelSetList::ARRAY_STR_FUNCTIONS_TO_STATIC_CALL,
        LaravelSetList::LARAVEL_CODE_QUALITY,
        LaravelSetList::LARAVEL_COLLECTION,
        LaravelSetList::LARAVEL_FACADE_ALIASES_TO_FULL_NAMES,
    ])
    ->withParallel(
        timeoutSeconds: 600,
        maxNumberOfProcess: 16,
        jobSize: 16,
    );
