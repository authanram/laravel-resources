<?php

namespace Authanram\Resources\Plugins\Actions;

use Illuminate\Http\Request;
use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Http\Actions\Action;

final class Blank implements ActionPluginContract
{
    public function handle(Action $action, Request $request): void
    {

    }
}
