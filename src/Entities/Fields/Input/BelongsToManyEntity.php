<?php

namespace Resources\Entities\Fields\Input;

use Illuminate\Support\Collection;
use Resources\Entities\Fields\BaseField;

class BelongsToManyEntity extends BaseField
{
    protected string $view = 'resources::fields.input.belongs-to-many';

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
