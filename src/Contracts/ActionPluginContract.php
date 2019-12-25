<?php

namespace Resources\Contracts;

use Illuminate\Http\Request;
use Resources\Http\Actions\Action;

interface ActionPluginContract
{
    public function handle(Action $action, Request $request): void;
}
