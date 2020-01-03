<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

use Authanram\Resources\Entities\Fields\BaseField;

trait IsBlock
{
    public function isBlock(BaseField $field): bool
    {
        return $field->getField()->block ?? false;
    }
}
