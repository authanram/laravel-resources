<?php

namespace Authanram\Resources\Plugins\Fields\Output;

use Authanram\Resources\Contracts\InputOutputFieldPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Entities\Fields\Output\Id as Entity;

final class Id implements InputOutputFieldPluginContract
{
    public static function getType(): string
    {
        return 'id';
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
