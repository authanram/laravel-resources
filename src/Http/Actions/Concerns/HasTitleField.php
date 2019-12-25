<?php

namespace Resources\Http\Actions\Concerns;

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
        return take($this->getRawResource())->get('actions.index.attributes.order.column');
    }

    private function getTitleFieldFromFillable(): string
    {
        $fillable = $this->getModel()->getFillable();

        return \array_shift($fillable);
    }
}
