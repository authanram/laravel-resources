<?php

namespace Authanram\Resources\Entities;

class Invoker
{
    public ?bool $valueComparator = null;

    public ?int $sortOrder = null;

    public ?string $icon = null;

    public ?string $permission = null;

    public ?string $separator = null;

    public ?string $valueColumn = null;

    public ?string $key = null;

    public ?string $label = null;

    public ?string $routeKey = null;

    public ?string $theme = null;

    public static function make(array $attributes): self
    {
        return (new self)->setAttributes($attributes);
    }

    public function setAttributes(array $attributes): self
    {
        $this->icon = data_get($attributes,'icon', $this->icon);

        $this->key = data_get($attributes,'key', $this->key);

        $this->label = data_get($attributes,'label', $this->label);

        $this->permission = data_get($attributes,'permission', $this->permission);

        $this->routeKey = data_get($attributes,'routeKey', $this->routeKey);

        $this->separator = data_get($attributes,'separator', $this->separator);

        $this->sortOrder = data_get($attributes,'sortOrder', $this->sortOrder ?? 0);

        $this->theme = data_get($attributes,'theme', $this->theme ?? 'resources.invokers.variants.default');

        $this->valueColumn = data_get($attributes,'valueColumn', $this->valueColumn);

        $this->valueComparator = data_get($attributes,'valueComparator', $this->valueComparator);

        return $this;
    }
}
