<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;

final class ActionsIndexFieldDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        $indexFields = (array)data_get($resource, 'actions.index.fields', (object)[]);

        if ($indexFields) {

            return $resource;

        }

        $rawFields = get_object_vars($resource->fields);

        $fields = static::makeIndexFields($rawFields);

        return data_set($resource, 'actions.index.fields', (object)$fields);
    }

    private static function makeIndexFields(array $fields): array
    {
        $indexFieldsAll = [];

        $fn = fn ($field, $key) => $key !== 'id';

        $filteredFields = collect($fields)->filter($fn);

        foreach ($filteredFields->toArray() as $key => $field) {

            $indexFieldsAll[$key] = $field;

            $indexFieldsAll[$key]->attribute = $key;

        }

        $fn = fn (\stdClass $field) => \in_array($field->attribute, ['created_at', 'updated_at']);

        return array_merge(

            collect($indexFieldsAll)->take(3)->toArray(),

            $filteredFields->filter($fn)->toArray()

        );
    }
}
