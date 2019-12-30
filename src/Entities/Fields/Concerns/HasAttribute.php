<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasAttribute
{
    protected string $attribute;

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function setAttribute(string $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }
}
