<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasError
{
    protected ?string $error = null;

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }
}
