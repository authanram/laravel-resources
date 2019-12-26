<?php

namespace Authanram\Resources\Entities;

use Authanram\Resources\Theme;

class Invoker
{
    public ?bool $valueComparator = null;

    public ?int $sortOrder = null;

    public ?string $bgColor = null;

    public ?string $color = null;

    public ?string $icon = null;

    public ?string $permission = null;

    public ?string $separator = null;

    public ?string $valueColumn = null;

    public ?string $key = null;

    public ?string $label = null;

    public ?string $routeKey = null;

    public static function make(array $attributes): self
    {
        return (new self)->setAttributes($attributes);
    }

    public function setAttributes(array $attributes): self
    {
        $this->bgColor = take($attributes)->get('bgColor', $this->bgColor ?? Theme::getValue('invokers.background'));

        $this->color = take($attributes)->get('color', $this->color ?? Theme::getValue('accent'));

        $this->icon = take($attributes)->get('icon', $this->icon ?? Theme::getValue('invokers.icons.default'));

        $this->key = take($attributes)->get('key', $this->key);

        $this->label = take($attributes)->get('label', $this->label);

        $this->permission = take($attributes)->get('permission', $this->permission);

        $this->routeKey = take($attributes)->get('routeKey', $this->routeKey);

        $this->separator = take($attributes)->get('separator', $this->separator);

        $this->sortOrder = take($attributes)->get('sortOrder', $this->sortOrder ?? 0);

        $this->valueColumn = take($attributes)->get('valueColumn', $this->valueColumn);

        $this->valueComparator = take($attributes)->get('valueComparator', $this->valueComparator);

        return $this;
    }
}
