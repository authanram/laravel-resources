<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasClass
{
    protected ?string $class = null;

    public function getClass(string $append = null): ?string
    {
        return trim("$this->class $append");
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }
}
