<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasRelations
{
    protected array $relations;

    public function getRelations(): array
    {
        return $this->relations;
    }

    public function setRelations(array $relations): self
    {
        $this->relations = $relations;

        return $this;
    }
}
