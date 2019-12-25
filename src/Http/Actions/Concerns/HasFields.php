<?php

namespace Resources\Http\Actions\Concerns;

use Illuminate\Support\Collection;
use Resources\Entities\Fields\BaseField;

trait HasFields
{
    public Collection $fields;

    /**
     * @return Collection|BaseField[]
     */
    public function getFields(): Collection
    {
        return $this->fields ?? collect();
    }

    /**
     * @param Collection|BaseField[] $fields
     *
     * @return self
     */
    public function setFields(Collection $fields): self
    {
        $this->fields = $fields;

        return $this;
    }
}
