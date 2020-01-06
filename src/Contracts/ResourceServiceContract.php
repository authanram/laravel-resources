<?php

namespace Authanram\Resources\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ResourceServiceContract
{
    public static function getModel(?Model $model, ?Request $request): Model;

    public static function getResourceBySnakeName(string $snake): \stdClass;

    public static function getResources(): array;
}
