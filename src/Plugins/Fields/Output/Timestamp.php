<?php

namespace Resources\Plugins\Fields\Output;

use Carbon\Carbon;
use Resources\Contracts\InputOutputPluginContract;
use Resources\Entities\Fields\BaseField;

final class Timestamp implements InputOutputPluginContract
{
    public function handle(BaseField $field): void
    {
        /** @var Carbon $carbon */
        $carbon = $field->getValue();

        if (! $carbon instanceof Carbon) {

            return;

        }

        $attributes = $field->getField()->getAttributes();

        $diffForHumans = take($attributes)->get('diffForHumans');

        $timestamp = $diffForHumans

            ? $carbon->diffForHumans()

            : $carbon->format(config('resources.format_timestamp'));

        $field->setValue($timestamp);
    }
}
