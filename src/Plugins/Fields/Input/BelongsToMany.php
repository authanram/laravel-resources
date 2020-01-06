<?php

namespace Authanram\Resources\Plugins\Fields\Input;

use Authanram\Resources\Contracts\InputOutputFieldPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Entities\Fields\Input\BelongsToMany as Entity;
use Authanram\Resources\Helpers\ResourceResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

final class BelongsToMany implements InputOutputFieldPluginContract
{
    public static function getType(): string
    {
        return 'belongsToMany';
    }

    public static function getEntity(): string
    {
        return Entity::class;
    }

    public function handle(BaseField $field): void
    {
        $attribute = $field->getAttribute();

        /** @var Model $relationClass */
        $relationClass = ResourceResolver::makeModelClassNameFromCamelName($attribute);

        $relationInstance = new $relationClass;

        $orderColumn = static::makeOrderColumn($field->getField(), $relationInstance);

        $association = static::makeAssociation($relationInstance, $orderColumn);

        $field->setAssociation($association);
    }

    private static function makeOrderColumn(Fluent $field, Model $model): string
    {
        $orderColumn = data_get($field, 'rawResource.actions.index.attributes.order.column');

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
