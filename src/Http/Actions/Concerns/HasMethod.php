<?php

namespace Resources\Http\Actions\Concerns;

trait HasMethod
{
    protected string $method;

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }
}
