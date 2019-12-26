<?php

namespace Authanram\Resources\Contracts;

interface ReaderServiceContract
{
    public static function getResource(string $tableName): \stdClass;

    public static function getResourceNames(): array;
}
