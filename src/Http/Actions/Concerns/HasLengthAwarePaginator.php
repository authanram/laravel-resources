<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait HasLengthAwarePaginator
{
    protected LengthAwarePaginator $lengthAwarePaginator;

    public function getLengthAwarePaginator(): LengthAwarePaginator
    {
        return $this->lengthAwarePaginator;
    }

    public function setLengthAwarePaginator(LengthAwarePaginator $lengthAwarePaginator): self
    {
        $this->lengthAwarePaginator = $lengthAwarePaginator;

        return $this;
    }
}
