<?php

namespace Authanram\Resources\Plugins\Fields;

use Authanram\Resources\Contracts\InputOutputPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;

final class SetClassAttribute implements InputOutputPluginContract
{
    public function handle(BaseField $field): void
    {
        $class = $field->getField()->get('class');

        $field->setClass($class);
    }
}
