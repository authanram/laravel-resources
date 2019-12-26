<?php

namespace Resources\Plugins\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Resources\Contracts\ActionPluginContract;
use Resources\Entities\Fields\BaseField;
use Resources\Http\Actions\Action;
use Resources\Http\Actions\Concerns\ProvidesInvokers;

final class SetInvokers implements ActionPluginContract
{
    use ProvidesInvokers;

    private Collection $invokers;

    public function handle(Action $action, Request $request): void
    {
        $this->invokers = collect();

        $this->makeDefaultInvokers();

        $this->makeResourceInvokers();

        $action->setInvokers($this->invokers);
    }

    private function makeDefaultInvokers(): void
    {
        $this->invokers

            ->add($this->getInvokerEdit())

            ->add($this->getInvokerDuplicate())

            ->add($this->getInvokerShow())

            ->add($this->getInvokerDestroy());
    }

    private function makeResourceInvokers(): void
    {

    }
}
