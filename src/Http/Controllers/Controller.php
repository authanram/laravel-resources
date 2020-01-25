<?php

namespace Authanram\Resources\Http\Controllers;

use App\Http\Controllers\Controller as AppController;
use Authanram\Resources\Contracts\ResourceServiceContract;
use Authanram\Resources\Http\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Controller extends AppController
{
    protected ResourceServiceContract $resourceService;

    protected Action $action;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function setup(Request $request, ?Model $model, Action $action): void
    {
        $model = $model ?? $this->resourceService::getModel($request);

        $raw = $this->resourceService::getResourceByTableName($model->getTable());

        $this->action = $action

            ->setBreadcrumbsCallback(static::getBreadcrumbsCallback())

            ->setPermissionCallback(static::getPermissionsCallback())

            ->setModel($model)

            ->setRawResource($raw)

            ->handle($request);
    }
}
