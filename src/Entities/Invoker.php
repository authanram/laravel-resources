<?php

namespace Authanram\Resources\Entities;

use Authanram\Resources\Theme;

class Invoker
{
    protected ?bool $valueComparator;

    protected ?int $sortOrder;

    protected ?string $bgColor;

    protected ?string $color;

    protected ?string $icon;

    protected ?string $permission;

    protected ?string $separator;

    protected ?string $valueColumn;

    protected string $key;

    protected string $label;

    protected string $routeKey;

    public static function make(array $attributes): self
    {
        $instance = new self;

        $instance->bgColor = take($attributes)->get('bgColor', Theme::getValue('invokers.background'));

        $instance->color = take($attributes)->get('color', Theme::getValue('accent'));

        $instance->icon = take($attributes)->get('icon', Theme::getValue('invokers.icons.default'));

        $instance->key = take($attributes)->get('key');

        $instance->label = take($attributes)->get('label');

        $instance->permission = take($attributes)->get('permission');

        $instance->routeKey = take($attributes)->get('routeKey');

        $instance->separator = take($attributes)->get('separator');

        $instance->sortOrder = take($attributes)->get('sortOrder', 0);

        $instance->valueColumn = take($attributes)->get('valueColumn');

        $instance->valueComparator = take($attributes)->get('valueComparator');

        return $instance;
    }

    public function getValueComparator(): ?bool
    {
        return $this->valueComparator;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function getBgColor(): ?string
    {
        return $this->bgColor;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getPermission(): ?string
    {
        return $this->permission;
    }

    public function getSeparator(): ?string
    {
        return $this->separator;
    }

    public function getValueColumn(): ?string
    {
        return $this->valueColumn;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getRouteKey(): string
    {
        return $this->routeKey;
    }

    public function setValueComparator(?bool $valueComparator): Invoker
    {
        $this->valueComparator = $valueComparator;

        return $this;
    }

    public function setSortOrder(?int $sortOrder): Invoker
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function setBgColor(?string $bgColor): Invoker
    {
        $this->bgColor = $bgColor;

        return $this;
    }

    public function setColor(?string $color): Invoker
    {
        $this->color = $color;

        return $this;
    }

    public function setIcon(?string $icon): Invoker
    {
        $this->icon = $icon;

        return $this;
    }

    public function setPermission(?string $permission): Invoker
    {
        $this->permission = $permission;

        return $this;
    }

    public function setSeparator(?string $separator): Invoker
    {
        $this->separator = $separator;

        return $this;
    }

    public function setValueColumn(?string $valueColumn): Invoker
    {
        $this->valueColumn = $valueColumn;

        return $this;
    }

    public function setKey(string $key): Invoker
    {
        $this->key = $key;

        return $this;
    }

    public function setLabel(string $label): Invoker
    {
        $this->label = $label;

        return $this;
    }

    public function setRouteKey(string $routeKey): Invoker
    {
        $this->routeKey = $routeKey;

        return $this;
    }
}
