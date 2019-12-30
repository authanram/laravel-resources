<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

use Authanram\Resources\Entities\Fields\Field;

trait HasField
{
    protected Field $field;

    public function getField(): Field
    {
        return $this->field;
    }

    public function setField(Field $field): self
    {
        $this->field = $field;

        return $this;
    }
}
