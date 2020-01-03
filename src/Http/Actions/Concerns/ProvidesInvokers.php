<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Authanram\Resources\Entities\Invoker;

trait ProvidesInvokers
{
    public function getInvokerEdit(): Invoker
    {
        return Invoker::make([
            'icon' => 'resources.invokers.icons.edit',
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
            'icon' => 'resources.invokers.icons.duplicate',
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
            'icon' => 'resources.invokers.icons.show',
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
            'icon' => 'resources.invokers.icons.publish',
            'key' => 'publish',
            'label' => 'Publish',
            'permission' => 'edit',
            'routeKey' => 'edit',
            'sortOrder' => 40,
            'theme' => 'resources.invokers.variants.success',
        ]);
    }

    public function getInvokerUnpublish(): Invoker
    {
        return Invoker::make([
            'icon' => 'resources.invokers.icons.unpublish',
            'key' => 'unpublish',
            'label' => 'Unpublish',
            'permission' => 'edit',
            'routeKey' => 'edit',
            'sortOrder' => 40,
            'theme' => 'resources.invokers.variants.warning',
        ]);
    }

    public function getInvokerDestroy(): Invoker
    {
        return Invoker::make([
            'icon' => 'resources.invokers.icons.destroy',
            'key' => 'destroy',
            'label' => 'Delete',
            'permission' => 'show',
            'routeKey' => 'destroy',
            'sortOrder' => 50,
            'theme' => 'resources.invokers.variants.danger',
        ]);
    }
}
