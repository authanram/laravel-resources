<?php

namespace Authanram\Resources\Plugins\Fields\Output;

use Carbon\Carbon;
use Authanram\Resources\Contracts\InputOutputFieldPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Entities\Fields\Output\Timestamp as Entity;

final class Timestamp implements InputOutputFieldPluginContract
{
    public static function getType(): string
    {
        return 'timestamp';
    }

    public static function getEntity(): string
    {
        return Entity::class;
    }

    public function handle(BaseField $field): void
    {
        /** @var Carbon $carbon */
        $carbon = $field->getValue();

        if (! $carbon instanceof Carbon) {

            return;

        }

        $attributes = $field->getField()->getAttributes();

        $diffForHumans = data_get($attributes, 'diffForHumans');

        $timestamp = $diffForHumans

            ? $carbon->diffForHumans()

            : $carbon->format(config('authanram-resources.format_timestamp'));

        $field->setValue($timestamp);
    }
}
