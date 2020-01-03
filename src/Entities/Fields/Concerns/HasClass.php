<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasClass
{
    protected ?string $class = null;

    public function getClass(string $action, string $append = null, string $default = null): ?string
    {
        $class = $this->class ?? theme("resources.actions.$action.fields.default", $default, false);

        return trim("$class $append");
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }
}
