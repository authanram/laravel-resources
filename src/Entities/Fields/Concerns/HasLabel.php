<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasLabel
{
    protected ?string $label = null;

    protected ?string $labelFalse = null;

    protected ?string $labelTrue = null;

    protected string $labelView = 'authanram-resources::actions.label';

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getLabelView(): ?string
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

    public function getLabelFalse(): ?string
    {
        return $this->labelFalse;
    }

    public function getLabelTrue(): ?string
    {
        return $this->labelTrue;
    }

    public function setLabelFalse(string $labelFalse): self
    {
        $this->labelFalse = $labelFalse;

        return $this;
    }

    public function setLabelTrue(string $labelTrue): self
    {
        $this->labelTrue = $labelTrue;

        return $this;
    }
}
