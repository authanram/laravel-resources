<?php

namespace Authanram\Resources\Http\Actions\Concerns;

trait HasTitleField
{
    protected ?string $titleField;

    public function getTitleField(): string
    {
        if (! $this->titleField) {
            $this->titleField = $this->getTitleFieldFromRawFields() ?? $this->getTitleFieldFromFillable();
        }

        return $this->titleField;
    }

    private function getTitleFieldFromRawFields(): ?string
    {
        return data_get($this->getRawResource(), 'actions.index.attributes.order.column');
    }

    private function getTitleFieldFromFillable(): string
    {
        $fillable = $this->getModel()->getFillable();

        $titleField = \array_shift($fillable);

        if (!empty($fillable)) {

            return $titleField;

        }

        $attributes = $this->getModel()->getAttributes();

        $keys = array_keys($attributes);

        return \array_shift($keys);
    }
}
