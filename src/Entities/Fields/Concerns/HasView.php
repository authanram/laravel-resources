<?php

namespace Authanram\Resources\Entities\Fields\Concerns;

trait HasView
{
    protected string $view;

    public function getView(): string
    {
        return $this->view;
    }

    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }
}
