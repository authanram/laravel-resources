<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

use Illuminate\Support\Collection;

trait HasInvokers
{
    protected Collection $invokers;

    public function getInvokers(): Collection
    {
        return $this->invokers;
    }

    public function setInvokers(Collection $invokers): self
    {
        $this->invokers = $invokers;

        return $this;
    }
}
