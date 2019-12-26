<?php

namespace Authanram\Resources\Contracts;

use Illuminate\Http\Request;
use Authanram\Resources\Http\Actions\Action;

interface ActionPluginContract
{
    public function handle(Action $action, Request $request): void;
}
