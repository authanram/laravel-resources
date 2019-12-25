<?php

namespace Resources\Http\Controllers;

use App\Http\Controllers\Controller as AppController;
use App\Model;
use Illuminate\Http\Request;
use Resources\Contracts\ReaderServiceContract;
use Resources\Contracts\ResourceServiceContract;
use Resources\Http\Actions\Action;

class Controller extends AppController
{
    protected ReaderServiceContract $readerService;

    protected ResourceServiceContract $resourceService;

    protected Model $model;

    protected \stdClass $raw;

    protected Action $action;

    public function __construct(ReaderServiceContract $readerService, ResourceServiceContract $resourceService)
    {
        $this->readerService = $readerService;

        $this->resourceService = $resourceService;
    }

    public function setup(Request $request, ?Model $model, Action $action): void
    {
        $this->model = $this->resourceService::getModel($model, $request);

        $this->raw = $this->readerService::getResource($this->model->getTable());

        $this->action = $this->makeAction($request, $action);
    }

    private function makeAction(Request $request, Action $action): Action
    {
        return $action

            ->setModel($this->model)

            ->setRawResource($this->raw)

            ->handle($request);
    }
}
