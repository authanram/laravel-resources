<?php

namespace Authanram\Resources\Plugins\Actions;

use App\Model;
use Authanram\Resources\Helpers\NameResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Http\Actions\Action;

final class SetAssociations implements ActionPluginContract
{
    public function handle(Action $action, Request $request): void
    {
//        $viewService = app()->make(ViewServiceContract::class);
//
//        $associations = data_get($resourceEntity, 'raw.actions.show.associations');
//
//        $parentModel = $resourceEntity->getModel();
//
//        $resourceEntity->getViewModel()->associations = collect($associations)
//
//            ->map(static function (\stdClass $association) use ($viewService, $parentModel) {
//
//                $model = static::getModelByAssociationName($association->name);
//
//                $resourceEntity = $viewService->getResourceEntity(null, $model);
//
//                $paginator = $parentModel->{$association->name}()->paginate();
//
//                $resourceEntity->setAssociation($paginator);
//
//                return (new IndexAction)->handle($resourceEntity)->render();
//
//            });
//
//        return $resourceEntity;
    }

    private static function getModelByAssociationName(string $associationName): Model
    {
        $className = NameResolver::makeModelClassNameFromCamelName($associationName);

        return new $className;
    }
}
