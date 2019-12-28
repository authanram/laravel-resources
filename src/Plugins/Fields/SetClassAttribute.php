<?php

namespace Authanram\Resources\Plugins\Fields;

use Authanram\Resources\Contracts\InputOutputPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;

final class SetClassAttribute implements InputOutputPluginContract
{
    public function handle(BaseField $field): void
    {
        $interactionType = $field->getField()->getInteractionType();

        $defaultClassAttribute = theme("fields.default.$interactionType");

        $class = $field->getField()->get('class', $defaultClassAttribute);

        $field->setClass($class);
    }
}
