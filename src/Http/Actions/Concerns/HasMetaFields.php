<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Support\Collection;
use Authanram\Resources\Entities\Fields\BaseField;

trait HasMetaFields
{
    public Collection $metaFields;

    /**
     * @return Collection|BaseField[]
     */
    public function getMetaFields(): Collection
    {
        return $this->metaFields ?? collect();
    }

    /**
     * @param Collection|BaseField[] $metaFields
     *
     * @return self
     */
    public function setMetaFields(Collection $metaFields): self
    {
        $this->metaFields = $metaFields;

        return $this;
    }
}
