<?php

namespace Resources\Entities\Fields\Output;

use Resources\Entities\Fields\BaseField;

class BelongsToManyEntity extends BaseField
{
    protected string $view = 'authanram-resources::fields.output.belongs-to-many';

    public function getValue(): int
    {
        return $this->getField()

            ->getModel()

            ->{$this->getAttribute()}

            ->count();
    }
}
