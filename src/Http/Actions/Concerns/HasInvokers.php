<?php

namespace Resources\Http\Actions\Concerns;

trait HasInvokers
{
    protected string $invokers;

    public function getInvokers(): string
    {
        return $this->invokers;
    }

    public function setInvokers(string $invokers): self
    {
        $this->invokers = $invokers;

        return $this;
    }
}
