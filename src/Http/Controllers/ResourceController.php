<?php

namespace Authanram\Resources\Http\Controllers;

use Authanram\Resources\Http\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourceController extends Controller
{
    public function index(Request $request): View
    {
        $this->setup($request, null, new Actions\IndexAction);

        return $this->action->render();
    }

    public function create(Request $request): View
    {
        $this->setup($request, null, new Actions\CreateAction);

        return $this->action->render();
    }

    public function edit(Request $request, Model $model): View
    {
        $this->setup($request, $model, new Actions\EditAction);

        return $this->action->render();
    }

    public function show(Request $request, Model $model): View
    {
        $this->setup($request, $model, new Actions\ShowAction);

        return $this->action->render();
    }

    //

    public function destory(Request $request)
    {
        //return (new Actions\DestroyAction)->handle($request);
    }

    public function restore(Request $request)
    {
        //return (new Actions\RestoreAction)->handle($request);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->setup($request, null, new Actions\StoreAction);

        return $this->action->run($request);
    }

    public function update(Request $request, Model $model): RedirectResponse
    {
        $this->setup($request, $model, new Actions\UpdateAction);

        return $this->action->run($request);
    }

    //

    public function resources(): string
    {
        return 'Resources';
    }
}
