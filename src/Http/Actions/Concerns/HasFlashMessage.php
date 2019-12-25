<?php

namespace Resources\Http\Actions\Concerns;

use Resources\Entities\FlashMessage;

trait HasFlashMessage
{
    protected ?FlashMessage $flashMessage;

    public function getFlashMessage(): ?FlashMessage
    {
        return $this->flashMessage;
    }

    public function setFlashMessage(FlashMessage $flashMessage): self
    {
        $this->flashMessage = $flashMessage;

        return $this;
    }
}
