<?php

namespace Authanram\Resources\Plugins\Fields;

use Authanram\Resources\Contracts\InputOutputPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Theme;

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
