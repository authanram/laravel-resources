<?php

namespace Resources\Contracts;

use Resources\Entities\Fields\BaseField;

interface InputOutputPluginContract
{
    public function handle(BaseField $field): void;
}
