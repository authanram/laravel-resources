<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasValue
{
    protected $value;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }
}
