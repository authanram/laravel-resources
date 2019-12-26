<?php

namespace Authanram\Resources\Plugins\Actions;

use Illuminate\Http\Request;
use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Entities\Association;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Http\Actions\Action;

final class SetLengthAwarePaginator implements ActionPluginContract
{
    public function handle(Action $action, Request $request): void
    {
        $associations = static::getAssociations($action);

        $orderBy = static::getOrderBy($action);

        $orderDirection = static::getOrderDirection($action);

        $perPage = static::getPerPage($action);

        $lengthAwarePaginator = $action->getModel()::with($associations)

            ->orderBy($orderBy, $orderDirection)

            ->paginate($perPage);

        $action->setLengthAwarePaginator($lengthAwarePaginator);
    }

    private static function getAssociations(Action $action): array
    {
        $fn = fn (BaseField $field) => \in_array($field->getType(), Association::TYPES, true);

        $associationFields = $action->getFields()->filter($fn);

        $fn = fn (BaseField $field) => $field->getAttribute();

        return $associationFields->map($fn)->values()->toArray();
    }

    private static function getOrderBy(Action $action): string
    {
        return take($action->getRawResource())->get('actions.index.attributes.order.column', 'id');
    }

    private static function getOrderDirection(Action $action): string
    {
        return take($action->getRawResource())->get('actions.index.attributes.order.direction', 'asc');
    }

    private static function getPerPage(Action $action): int
    {
        $modelPerPage = $action->getModel()->getPerPage();

        $resourcePerPage = take($action->getRawResource())->get('actions.index.attributes.per_page');

        return $resourcePerPage ?? $modelPerPage;
    }
}
