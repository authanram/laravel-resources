<?php

namespace Authanram\Resources\Plugins\Fields\Output;

use Carbon\Carbon;
use Authanram\Resources\Contracts\InputOutputPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;

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

            : $carbon->format(config('authanram-resources.format_timestamp'));

        $field->setValue($timestamp);
    }
}
