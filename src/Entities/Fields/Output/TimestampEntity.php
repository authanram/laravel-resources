<?php

namespace Resources\Entities\Fields\Output;

use Illuminate\Support\Str;
use Resources\Entities\Fields\BaseField;

class TimestampEntity extends BaseField
{
    protected string $view = 'authanram-resources::fields.output.timestamp';

    public function getDate(): string
    {
        return Str::before($this->getValue(), ',');
    }

    public function getTime(): string
    {
        return Str::after($this->getValue(), ',');
    }

    public function isDiffForHumans(): bool
    {
        return take($this->field->getAttributes())->get('diffForHumans', false);
    }
}
