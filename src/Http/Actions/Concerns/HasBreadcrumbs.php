<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Support\Fluent;

trait HasBreadcrumbs
{
    protected ?\Closure $breadcrumbsCallback = null;

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

    public function setBreadcrumbsCallback(?\Closure $breadcrumbsCallback): self
    {
        $this->breadcrumbsCallback = $breadcrumbsCallback;

        return $this;
    }

    /**
     * @param \Illuminate\Support\Fluent[] $breadcrumbs
     *
     * @return self
     */
    public function setBreadcrumbs(array $breadcrumbs): self
    {
        $this->breadcrumbs = $breadcrumbs;

        $this->invokeCallback($this->breadcrumbs);

        return $this;
    }

    /**
     * @param Fluent[] $breadcrumbs
     */
    private function invokeCallback(array $breadcrumbs): void
    {
        $callback = $this->breadcrumbsCallback;

        if ($callback && \is_callable($callback)) {

            foreach ($breadcrumbs as $breadcrumb) {

                $url = $breadcrumb->get('url');

                $text = $breadcrumb->get('text');

                $target = '_self';

                $callback($text, $url, $target);

            }

        }
    }
}
