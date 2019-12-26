<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use App\Model;

trait HasModel
{
    protected Model $model;

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }
}
