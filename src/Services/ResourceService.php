<?php

namespace Authanram\Resources\Services;

use App\Model;
use Authanram\Resources\Contracts\ResourceServiceContract;
use Authanram\Resources\Entities\Association;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

class ResourceService implements ResourceServiceContract
{
    public static function getModel(?Model $model, ?Request $request): Model
    {
        return $model || ! $request ? $model : static::getModelFromRequestPathSegment($request);
    }

    public static function getResource(string $tableName, bool $withAssociations = true): \stdClass
    {
        $resourceName = static::makeResourceFileName($tableName);

        $resource = config("authanram-resources.resources.$resourceName");

        $resource->fields->id = (object)['type' => 'id'];

        $resource->asscociations = new Fluent();

        return $withAssociations ? static::makeResourceAssociations($resource) : $resource;
    }

    public static function getResources(): array
    {
        $files = File::allFiles(config('authanram-resources.path'));

        $fn = static function (SplFileInfo $fileInfo) {

            $filename = pathinfo($fileInfo->getFilename(), PATHINFO_FILENAME);

            $resource = Yaml::parseFile($fileInfo->getPathname(), Yaml::PARSE_OBJECT_FOR_MAP);

            return [$filename => $resource];

        };

        return collect($files)->mapWithKeys($fn)->toArray();
    }

    private static function getModelFromRequestPathSegment(Request $request): Model
    {
        $prefixes = config('authanram-resources.routes.prefixes');

        $segments = collect($request->segments());

        $segment = $segments->offsetGet(\count($prefixes));

        $singularSegment = Str::singular($segment);

        $shortName = Str::studly($singularSegment);

        $className = config('authanram-resources.namespaces.models') . "\\$shortName";

        return new $className;
    }

    private static function makeResourceFileName(string $table): string
    {
        $singularTable = Str::slug($table, '-');

        return Str::singular($singularTable);
    }

    private static function makeResourceAssociations(\stdClass $resource): \stdClass
    {
        $fn = fn (\stdClass $field) => \in_array($field->type, Association::TYPES_PIVOT, true);

        $associations = collect($resource->fields)->filter($fn)->keys();

        foreach ($associations as $association) {

            $snakeAssociation = Str::snake($association);

            $associationResource = static::getResource($snakeAssociation, false);

            $resource->asscociations->{$association} = $associationResource;

        }

        return $resource;
    }
}
