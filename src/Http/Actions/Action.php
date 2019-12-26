<?php

namespace Resources\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\View\View;
use Resources\Contracts\ActionPluginContract;
use Resources\Http\Actions\Concerns;

abstract class Action extends Fluent
{
    use Concerns\CanDump;
    use Concerns\HasAction;
    use Concerns\HasBreadcrumbs;
    use Concerns\HasFields;
    use Concerns\HasFlashMessage;
    use Concerns\HasInteractionType;
    use Concerns\HasInvokers;
    use Concerns\HasLengthAwarePaginator;
    use Concerns\HasMethod;
    use Concerns\HasModel;
    use Concerns\HasPlugins;
    use Concerns\HasRawResource;
    use Concerns\HasResourceName;
    use Concerns\HasRoutes;
    use Concerns\HasThemeMethod;
    use Concerns\HasTitleField;
    use Concerns\HasView;

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function set(string $key, $value): self
    {
        $this->{$key} = $value;

        return $this;
    }

    public function handle(Request $request): self
    {
        $this->routes = $this->makeRoutes($request);

        $fn = fn(ActionPluginContract $plugin) => $plugin->handle($this, $request);

        $this->getPlugins()->each($fn);

        return $this;
    }

    public function render(): View
    {
        return view($this->view, ['action' => $this]);
    }
}
