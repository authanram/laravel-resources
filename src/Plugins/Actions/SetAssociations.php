<?php

namespace Authanram\Resources\Plugins\Actions;

use App\Model;
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
//        $associations = take($resourceEntity)->toCollection('raw.actions.show.associations');
//
//        $parentModel = $resourceEntity->getModel();
//
//        $resourceEntity->getViewModel()->associations = $associations
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
        $singular = Str::singular($associationName);

        $shortName = Str::studly($singular);

        $className = config('authanram-resources.namespaces.models') . "\\$shortName";

        return new $className;
    }
}
