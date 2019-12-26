<?php

namespace Authanram\Resources\Http\Actions\Concerns;

trait HasAction
{
    protected string $action;

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }
}
