<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Authanram\Resources\Entities\Invoker;
use Authanram\Resources\Theme;

trait ProvidesInvokers
{
    public function getInvokerEdit(): Invoker
    {
        return Invoker::make([
            'icon' => Theme::getValue('invokers.icons.edit'),
            'key' => 'edit',
            'label' => 'Edit',
            'permission' => 'edit',
            'routeKey' => 'edit',
            'sortOrder' => 10,
        ]);
    }

    public function getInvokerDuplicate(): Invoker
    {
        return Invoker::make([
            'icon' => Theme::getValue('invokers.icons.duplicate'),
            'key' => 'duplicate',
            'label' => 'Duplicate',
            'permission' => 'duplicate',
            'routeKey' => 'edit',
            'sortOrder' => 20,
        ]);
    }

    public function getInvokerShow(): Invoker
    {
        return Invoker::make([
            'icon' => Theme::getValue('invokers.icons.show'),
            'key' => 'show',
            'label' => 'Show',
            'permission' => 'show',
            'routeKey' => 'show',
            'sortOrder' => 30,
        ]);
    }

    public function getInvokerPublish(): Invoker
    {
        return Invoker::make([
            'bgColor' => Theme::getValue('invokers.accents.success.background'),
            'color' => Theme::getValue('invokers.accents.success.color'),
            'icon' => Theme::getValue('invokers.icons.publish'),
            'key' => 'publish',
            'label' => 'Publish',
            'permission' => 'edit',
            'routeKey' => 'edit',
            'sortOrder' => 40,
        ]);
    }

    public function getInvokerUnpublish(): Invoker
    {
        return Invoker::make([
            'bgColor' => Theme::getValue('invokers.accents.danger.background'),
            'color' => Theme::getValue('invokers.accents.danger.color'),
            'icon' => Theme::getValue('invokers.icons.unpublish'),
            'key' => 'unpublish',
            'label' => 'Unpublish',
            'permission' => 'edit',
            'routeKey' => 'edit',
            'sortOrder' => 40,
        ]);
    }

    public function getInvokerDestroy(): Invoker
    {
        return Invoker::make([
            'bgColor' => Theme::getValue('invokers.accents.warning.background'),
            'color' => Theme::getValue('invokers.accents.warning.color'),
            'icon' => Theme::getValue('invokers.icons.destroy'),
            'key' => 'destroy',
            'label' => 'Delete',
            'permission' => 'show',
            'routeKey' => 'destroy',
            'sortOrder' => 50,
        ]);
    }
}
