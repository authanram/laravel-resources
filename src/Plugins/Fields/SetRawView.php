<?php

namespace Resources\Plugins\Fields;

use Illuminate\Support\Facades\View;
use Resources\Contracts\InputOutputPluginContract;
use Resources\Entities\Fields\BaseField;

final class SetRawView implements InputOutputPluginContract
{
    public function handle(BaseField $field): void
    {
        $this->handleField($field);
    }

    private function handleField(BaseField $field): void
    {
        $rawView = $field->getField()->get('view');

        if (!$rawView) {

            return;

        }

        $interactionType = $field->getField()->getInteractionType();

        $view = sprintf($rawView, $interactionType);

        if (! View::exists($view)) {

            return;

        }

        $field->setView($view);
    }
}
