<?php

namespace Authanram\Resources\Contracts;

use Authanram\Resources\Entities\Fields\BaseField;

interface InputOutputPluginContract
{
    public function handle(BaseField $field): void;
}
