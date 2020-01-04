<?php

namespace Authanram\Resources\Plugins\Actions;

use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Helpers\NameResolver;
use Authanram\Resources\Http\Actions\Action;
use Illuminate\Http\Request;

final class SetResourceName implements ActionPluginContract
{
    public function handle(Action $action, Request $request): void
    {
        $nameSingular = static::makeSingularResourceName($action);

        $action->set('resourceName', __($nameSingular));
    }

    private static function makeSingularResourceName(Action $action): string
    {
        $rawResourceName = data_get($action->getRawResource(), 'name');

        return $rawResourceName ?: NameResolver::makeResourceName($action->getModel());
    }
}
