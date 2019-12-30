<?php

namespace Authanram\Resources\Entities\Fields\Input;

use Illuminate\Support\Collection;
use Authanram\Resources\Entities\Fields\BaseField;

class BelongsToMany extends BaseField
{
    protected string $view = 'authanram-resources::fields.input.belongs-to-many';

    public function isSelected(int $id): bool
    {
        $value = $this->getValue();

        if (\is_array($value)) {

            /** @var Collection $value */
            $value = collect($value);

        }

        return \in_array($id, $value->pluck('id')->toArray(), true);
    }
}
