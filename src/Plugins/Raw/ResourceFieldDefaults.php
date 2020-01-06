<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;
use Authanram\Resources\Entities\Association;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class ResourceFieldDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        /** @var Model $instance */
        $instance = new $resource->model;

        $table = $instance->getTable();

        $columnsDefinitions = static::getColumnDefinitions($table);

        $fields = static::makeResourceFields($columnsDefinitions);

        $resource->fields = static::setAssociationsToFields($fields, $instance);

        return $resource;
    }

    private static function setAssociationsToFields(array $fields, Model $instance): \stdClass
    {
        $replace = [];

        foreach ($fields as $key => $value) {

            if (! Str::endsWith($key, '_id')) {

                continue;

            }

            $segment = rtrim($key, '_id');

            $method = Str::camel($segment);

            if (! method_exists($instance, $method)) {

                continue;

            }

            $fields[$key] = static::makeResourceField($key, Association::BELONGS_TO);

            $replace[$key] = $method;

        }

        $json = json_encode($fields, JSON_THROW_ON_ERROR, 512);

        foreach ($replace as $key => $value) {

            $json = str_replace($key, $value, $json);

        }

        return json_decode($json, false, 512, JSON_THROW_ON_ERROR);
    }

    private static function makeResourceFields(array $columns): array
    {
        return collect($columns)->mapWithKeys(static function (\stdClass $column) {

            $type = Str::before($column->Type, '(');

            $field = static::makeResourceField($column->Field, static::makeFieldType($type));

            return [$column->Field => $field];

        })->toArray();
    }

    private static function makeResourceField(string $attribute, string $type): \stdClass
    {
        return (object)compact('attribute', 'type');
    }

    private static function getColumnDefinitions(string $table): array
    {
        return DB::select(DB::raw("SHOW COLUMNS FROM $table"));
    }

    private static function makeFieldType(string $databaseType): string
    {
        return config("authanram-resources.fields.$databaseType", 'text');
    }
}
