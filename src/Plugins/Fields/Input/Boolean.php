<?php

namespace Authanram\Resources\Plugins\Fields\Input;

use Authanram\Resources\Contracts\InputOutputFieldPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Entities\Fields\Input\Boolean as Entity;

final class Boolean implements InputOutputFieldPluginContract
{
    public static function getType(): string
    {
        return 'boolean';
    }

    public static function getEntity(): string
    {
        return Entity::class;
    }

    public function handle(BaseField $field): void
    {
        //
    }
}
