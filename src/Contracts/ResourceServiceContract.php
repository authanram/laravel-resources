<?php

namespace Authanram\Resources\Contracts;

use App\Model;
use Illuminate\Http\Request;

interface ResourceServiceContract
{
    public static function getModel(?Model $model, ?Request $request): Model;
}
