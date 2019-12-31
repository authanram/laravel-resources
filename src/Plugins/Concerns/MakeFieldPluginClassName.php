<?php

namespace Authanram\Resources\Plugins\Concerns;

use Authanram\Resources\Contracts\InputOutputFieldPluginContract;

trait MakeFieldPluginClassName
{
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
}
