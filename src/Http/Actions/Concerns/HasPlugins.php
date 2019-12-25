<?php

namespace Resources\Http\Actions\Concerns;

use Illuminate\Support\Collection;

trait HasPlugins
{
    protected Collection $plugins;

    /**
     * @return Collection|\Resources\Contracts\ActionPluginContract[]
     */
    protected function getPlugins(): Collection
    {
        if (empty($this->plugins)) {

            $this->plugins = $this->makePlugins();

        }

        return $this->plugins;
    }

    private function makePlugins(): Collection
    {
        $defaultPluginClasses = config('resources::plugins.actions.default');

        $actionPluginClasses = config('resources::plugins.actions.' . $this->getAction());

        $pluginClasses = \array_merge($defaultPluginClasses, $actionPluginClasses);

        $fn = fn(string $plugin) => new $plugin;

        return collect($pluginClasses)->map($fn);
    }
}
