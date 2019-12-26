<?php

namespace Authanram\Resources\Plugins\Actions;

use Authanram\Resources\Entities\Invoker;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Http\Actions\Action;
use Authanram\Resources\Http\Actions\Concerns\ProvidesInvokers;
use Illuminate\Support\Str;

final class SetInvokers implements ActionPluginContract
{
    use ProvidesInvokers;

    private Collection $invokers;

    public function handle(Action $action, Request $request): void
    {
        $this->invokers = collect();

        $this->makeDefaultInvokers();

        $this->makeResourceInvokers($action);

        $this->invokers = $this->invokers->sortBy('sortOrder');

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

    private function makeResourceInvokers(Action $action): void
    {
        $invokers = take($action->getRawResource(), 'invokers')->toCollection();

        if (! $invokers->count()) {

            return;

        }

        $invokers

            ->each(function (\stdClass $invoker) {

                $studly = Str::studly($invoker->attribute);

                $method = "getInvoker$studly";

                /** @var Invoker $invokerInstance */
                $invokerInstance = $this->$method();

                $invokerInstance->setAttributes((array)$invoker);

                $this->invokers->add($invokerInstance);

            });
    }
}
