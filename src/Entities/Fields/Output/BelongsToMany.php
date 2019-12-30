<?php

namespace Authanram\Resources\Entities\Fields\Output;

use Authanram\Resources\Entities\Fields\BaseField;

class BelongsToMany extends BaseField
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
