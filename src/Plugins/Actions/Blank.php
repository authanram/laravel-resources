<?php

namespace Resources\Plugins\Actions;

use Illuminate\Http\Request;
use Resources\Contracts\ActionPluginContract;
use Resources\Http\Actions\Action;

final class Blank implements ActionPluginContract
{
    public function handle(Action $action, Request $request): void
    {

    }
}
