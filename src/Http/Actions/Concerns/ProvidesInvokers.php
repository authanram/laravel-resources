<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Authanram\Resources\Entities\Invoker;

trait ProvidesInvokers
{
    public function getInvokerEdit(): Invoker
    {
        return Invoker::make([
            'icon' => 'invokers.icons.edit',
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
            'icon' => 'invokers.icons.duplicate',
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
            'icon' => 'invokers.icons.show',
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
            'icon' => 'invokers.icons.publish',
            'key' => 'publish',
            'label' => 'Publish',
            'permission' => 'edit',
            'routeKey' => 'edit',
            'sortOrder' => 40,
            'theme' => 'invokers.accents.success',
        ]);
    }

    public function getInvokerUnpublish(): Invoker
    {
        return Invoker::make([
            'icon' => 'invokers.icons.unpublish',
            'key' => 'unpublish',
            'label' => 'Unpublish',
            'permission' => 'edit',
            'routeKey' => 'edit',
            'sortOrder' => 40,
            'theme' => 'invokers.accents.warning',
        ]);
    }

    public function getInvokerDestroy(): Invoker
    {
        return Invoker::make([
            'icon' => 'invokers.icons.destroy',
            'key' => 'destroy',
            'label' => 'Delete',
            'permission' => 'show',
            'routeKey' => 'destroy',
            'sortOrder' => 50,
            'theme' => 'invokers.accents.danger',
        ]);
    }
}
