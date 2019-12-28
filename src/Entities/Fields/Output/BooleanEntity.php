<?php

namespace Authanram\Resources\Entities\Fields\Output;

use Authanram\Resources\Entities\Fields\BaseField;

class BooleanEntity extends BaseField
{
    protected string $view = 'authanram-resources::fields.output.boolean';

    public function getVariant(): string
    {
        return $this->getValue() ? 'success' : 'danger';
    }
}
