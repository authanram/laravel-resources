<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Authanram\Resources\Http\Actions\Action;

trait MakesRedirectResponse
{
    private function makeRedirectResponse(Action $action, Request $request): RedirectResponse
    {
        $this->flashSuccess($action, $request);

        if ($request->input('_action')) {

            return Redirect::back();

        }

        $indexUrl = $action->getRoutes()->getIndexUrl();

        return Redirect::to($indexUrl);
    }
}
