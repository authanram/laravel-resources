<?php

namespace Resources\Http\Actions\Concerns;

use Illuminate\Support\Fluent;

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

        static::invokeCallback($this->breadcrumbs);

        return $this;
    }

    /**
     * @param Fluent[] $breadcrumbs
     */
    private static function invokeCallback(array $breadcrumbs): void
    {
        $callback  = config('authanram-resources.callbacks.breadcrumbs');

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
