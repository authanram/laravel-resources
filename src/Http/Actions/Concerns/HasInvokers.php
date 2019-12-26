<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Authanram\Resources\Entities\Invoker;
use Illuminate\Support\Collection;

trait HasInvokers
{
    protected Collection $invokers;

    /**
     * @return Collection|Invoker[]
     */
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
