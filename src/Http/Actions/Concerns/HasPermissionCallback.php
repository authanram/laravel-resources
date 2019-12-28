<?php

namespace Authanram\Resources\Http\Actions\Concerns;

trait HasPermissionCallback
{
    protected ?\Closure $permissionCallback = null;

    public function can(string $permission): bool
    {
        if (\is_callable($this->permissionCallback)) {

            return true;

        }

        $prefix = implode('.', config('authanram-resources.routes.prefixes'));

        $permissionFull = "$permission.$prefix";

        return $this->permissionCallback($permissionFull);
    }

    public function setPermissionCallback(?\Closure $permissionCallback): self
    {
        $this->permissionCallback = $permissionCallback;

        return $this;
    }
}
