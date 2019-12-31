<?php

namespace Authanram\Resources\Plugins\Concerns;

use Authanram\Resources\Contracts\InputOutputFieldPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Entities\Fields\Field;
use Illuminate\Support\Collection;

trait MakeField
{
    private function makeField(\stdClass $field, string $error = null): BaseField
    {
        $resourceField = $this->makeResourceFields()->get($field->attribute);

        /** @var InputOutputFieldPluginContract $pluginClassName */
        $pluginClassName = $this->makeFieldPluginClassName($resourceField, $this->action->getInteractionType());

        $rawResource = $this->makeAssociationRawResource($field);

        $mergedField = \array_merge((array)$field, (array)$resourceField, compact('rawResource'));

        $fieldEntity = new Field($mergedField);

        $fieldEntity->setInteractionType($this->action->getInteractionType());

        $fieldEntityClassName = $pluginClassName::getEntity();

        /** @var BaseField $fieldInstance */
        $fieldInstance = new $fieldEntityClassName($fieldEntity);

        $fieldInstance->setError($error);

        return $fieldInstance;
    }

    private function makeFieldPluginClassName(\stdClass $resourceField, string $interactionType): string
    {
        $plugins = collect(config("authanram-resources-plugins.fields.$interactionType"));

        $callback = static function (string $plugin) use ($resourceField) {

            /** @var InputOutputFieldPluginContract $plugin */
            return $plugin::getType() === $resourceField->type;

        };

        $pluginClass = $plugins->filter($callback)->first();

        if (! $pluginClass) {

            throw new \RuntimeException("Field type \"$resourceField->type\" not supported.");

        }

        return $pluginClass;
    }

    private function makeResourceFields(): Collection
    {
        return take($this->action->getRawResource(), 'fields')->toCollection();
    }

    private function makeAssociationRawResource(\stdClass $field): ?\stdClass
    {
        return $this->action->getRawResource()->asscociations->get($field->attribute);
    }
}
