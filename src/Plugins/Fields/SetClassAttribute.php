<?php

namespace Resources\Plugins\Fields;

use Resources\Contracts\InputOutputPluginContract;
use Resources\Entities\Fields\BaseField;
use Resources\Theme;

final class SetClassAttribute implements InputOutputPluginContract
{
    public function handle(BaseField $field): void
    {
        $interactionType = $field->getField()->getInteractionType();

        $defaultClassAttribute = Theme::getValue("fields.default.$interactionType");

        $class = $field->getField()->get('class', $defaultClassAttribute);

        $field->setClass($class);
    }
}
