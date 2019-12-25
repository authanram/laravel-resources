<?php

namespace Resources\Http\Actions\Concerns;

use Resources\Entities\InteractionType;

trait HasInteractionType
{
    protected ?string $interactionType;

    public function getInteractionType(): ?string
    {
        if (empty($this->interactionType)) {

            $action = $this->getAction();

            $this->interactionType = InteractionType::makeInteractionType($action);

        }

        return $this->interactionType;
    }
}
