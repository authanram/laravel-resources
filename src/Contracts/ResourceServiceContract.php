<?php

namespace Authanram\Resources\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ResourceServiceContract
{
    public static function getModel(Request $request): Model;

    public static function getResourceByTableName(string $snake): \stdClass;

    public static function getResources(): array;
}
