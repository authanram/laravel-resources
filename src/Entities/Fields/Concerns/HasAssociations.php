<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

use Illuminate\Support\Collection;

trait HasAssociations
{
    protected Collection $association;

    public function getAssociation(): Collection
    {
        return $this->association ?? collect();
    }

    public function setAssociation(Collection $association): self
    {
        $this->association = $association;

        return $this;
    }
}
