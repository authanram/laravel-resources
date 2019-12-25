<?php

namespace Resources\Plugins\Fields\Input;

use App\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Resources\Contracts\InputOutputPluginContract;
use Resources\Entities\Fields\BaseField;

final class BelongsToMany implements InputOutputPluginContract
{
    public function handle(BaseField $field): void
    {
        /** @var Model $relationClass */
        $relationClass = static::makeRelationClass($field->getAttribute());

        $relationInstance = new $relationClass;

        $orderColumn = static::makeOrderColumn($field->getField(), $relationInstance);

        $association = static::makeAssociation($relationInstance, $orderColumn);

        $field->setAssociation($association);
    }

    private static function makeRelationClass(string $attribute): string
    {
        $singularAttribute = Str::singular($attribute);

        $shortName = Str::studly($singularAttribute);

        $namespace = config('resources.namespaces.models');

        return $namespace . "\\$shortName";
    }

    private static function makeOrderColumn(Fluent $field, Model $model): string
    {
        $orderColumn = take($field)->get('rawResource.actions.index.attributes.order.column');

        if ($orderColumn) {

            return $orderColumn;

        }

        $fillable = $model->getFillable();

        return array_shift($fillable);
    }

    private static function makeAssociation(Model $model, string $orderColumn): Collection
    {
        /** @var Builder $model */
        return $model->orderBy($orderColumn)->get()->pluck('id', $orderColumn);
    }
}
