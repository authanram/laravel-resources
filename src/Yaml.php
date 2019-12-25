<?php

namespace Resources;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml
{
    public static function parseFile(string $filePath): \stdClass
    {
        if (! config('resources.cache.enabled')) {

            return static::parseFilePath($filePath);

        }

        $cacheKey = static::makeCacheKey($filePath);

        return Cache::rememberForever($cacheKey, static function () use ($filePath) {

            return static::parseFilePath($filePath);

        });
    }

    private static function parseFilePath(string $filePath): \stdClass
    {
        try {

            return SymfonyYaml::parseFile($filePath, SymfonyYaml::PARSE_OBJECT_FOR_MAP);

        } catch (ParseException $e) {

            Log::error($e->getMessage());

            abort(503, take($e->getMessage())->getIfLocal());

        }
    }

    private static function makeCacheKey(string $subject): string
    {
        $cacheKey = config('resources.cache.key');

        return ":$cacheKey:resource:" . md5($subject);
    }
}
