<?php

namespace Resources\Plugins\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Resources\Contracts\ActionPluginContract;
use Resources\Entities;
use Resources\Http\Actions\Action;

final class SetBreadcrumbs implements ActionPluginContract
{
    public function handle(Action $action, Request $request): void
    {
        $breadcrumbs = $this->makeBreadcrumbs($action);

        $filtered = collect($breadcrumbs)->filter();

        $action->setBreadcrumbs($filtered->all());
    }

    private function makeBreadcrumbs(Action $action): array
    {
        return [

            static::makeResourcesIndexBreadcrumb($action),

            static::makeIndexBreadcrumb($action),

            static::makeActionBreadcrumb($action),

        ];
    }

    private static function makeResourcesIndexBreadcrumb(Action $action): Fluent
    {
        $url = $action->getRoutes()->getResourcesUrl();

        return static::makeBreadCrumb(__('Resources'), $url);
    }

    private static function makeIndexBreadcrumb(Action $action): ?Fluent
    {
        $text = $action->makeResourceNamePlural();

        $url = $action->getRoutes()->getIndexUrl();

        return static::makeBreadCrumb($text, $url);
    }

    private static function makeActionBreadcrumb(Action $action): ?Fluent
    {
        $url = url()->current();

        $text = static::makeBreadcrumbText($action);

        return static::makeBreadCrumb($text, $url);
    }

    private static function makeBreadcrumbText(Action $action): ?string
    {
        $actionName = $action->getAction();

        $resourceName = $action->getResourceName();

        $name = Str::singular($resourceName ?? '');

        switch ($actionName) {

            case Entities\Action::INDEX:
                $text = null;
                break;

            case Entities\Action::CREATE:
                $text = __('Create :name', compact('name'));
                break;

            case Entities\Action::SHOW:
                $text = __(':name Details', compact('name'));
                break;

            default:
                $text = static::makeEditBreadcrumbText($action, $name);
        }

        return $text;
    }

    private static function makeEditBreadcrumbText(Action $action, ?string $name): ?string
    {
        $text = __('Edit :name', compact('name'));

        $titleField = $action->getTitleField();

        $titleValue = $action->getModel()->{$titleField};

        if ($titleValue) {

            $text = __('Edit') . " (%s$titleValue%s)";

        }

        return $text;
    }

    private static function makeBreadCrumb(?string $text, ?string $url): ?Fluent
    {
        $attributes = compact('text', 'url');

        return $text ? new Fluent($attributes) : null;
    }
}
