<?php

namespace Resources\Plugins\Actions;

use App\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Resources\Contracts\ActionPluginContract;
use Resources\Http\Actions\Action;

final class SetResourceName implements ActionPluginContract
{
    public function handle(Action $action, Request $request): void
    {
        $nameSingular = static::makeSingularResourceName($action);

        $action->set('resourceName', __($nameSingular));
    }

    private static function makeSingularResourceName(Action $action): string
    {
        $rawResourceName = take($action->getRawResource())->get('name');

        return $rawResourceName ?: static::makeResourceName($action->getModel());
    }

    private static function makeResourceName(Model $model): string
    {
        $shortName = static::makeClassShortName($model);

        return static::camelToTitleCase($shortName);
    }

    private static function makeClassShortName(Model $model): string
    {
        $className = \get_class($model);

        return Str::afterLast($className, '\\');
    }

    private static function camelToTitleCase(string $value): string
    {
        $snake = Str::snake($value);

        $title = Str::title($snake);

        return str_replace('_', ' ', $title);
    }
}
