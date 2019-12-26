<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Support\Str;

trait HasResourceName
{
    protected ?string $resourceName = null;

    public function getResourceName(): ?string
    {
        return $this->resourceName;
    }

    public function setResourceName(string $resourceName): HasResourceName
    {
        $this->resourceName = $resourceName;

        return $this;
    }

    public function makeResourceNamePlural(): string
    {
        return Str::plural($this->resourceName);
    }

    public function makeNameContinuousSingular(): string
    {
        return ucfirst(strtolower($this->resourceName));
    }
}
