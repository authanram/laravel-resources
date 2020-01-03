<?php

namespace Authanram\Resources\Plugins\Actions;

use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Entities;
use Authanram\Resources\Http\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;

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
                $text = static::makeEntityBreadcrumbText(__('Details of'), $action);
                break;

            default:
                $text = static::makeEntityBreadcrumbText(__('Edit'), $action);
        }

        return $text;
    }

    private static function makeEntityBreadcrumbText(string $text, Action $action): ?string
    {
        $titleField = $action->getTitleField();

        $titleValue = $action->getModel()->{$titleField};

        return $text . " %s$titleValue%s";
    }

    private static function makeBreadCrumb(?string $text, ?string $url): ?Fluent
    {
        $attributes = compact('text', 'url');

        return $text ? new Fluent($attributes) : null;
    }
}
