<?php

namespace Resources\Http\Actions\Concerns;

trait HasBreadcrumbs
{
    /**
     * @var \Illuminate\Support\Fluent[]
     */
    protected array $breadcrumbs = [];

    /**
     * @return \Illuminate\Support\Fluent[]
     */
    public function getBreadcrumbs(): array
    {
        return $this->breadcrumbs;
    }

    /**
     * @param \Illuminate\Support\Fluent[] $breadcrumbs
     *
     * @return self
     */
    public function setBreadcrumbs(array $breadcrumbs): self
    {
        $this->breadcrumbs = $breadcrumbs;

        return $this;
    }
}
