<?php

namespace Resources\Http\Actions\Concerns;

trait HasRawResource
{
    protected \stdClass $rawResource;

    public function getRawResource(): \stdClass
    {
        return $this->rawResource;
    }

    public function setRawResource(\stdClass $rawResource): self
    {
        $this->rawResource = $rawResource;

        return $this;
    }
}
