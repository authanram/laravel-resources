<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasLabel
{
    protected string $label;

    protected string $labelView = 'authanram-resources::actions.label';

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLabelView(): string
    {
        return $this->labelView;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function setLabelView(string $labelView): self
    {
        $this->labelView = $labelView;

        return $this;
    }
}
