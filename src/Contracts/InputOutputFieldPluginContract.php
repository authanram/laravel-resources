<?php

namespace Authanram\Resources\Contracts;

use Authanram\Resources\Entities\Fields\BaseField;

interface InputOutputFieldPluginContract
{
    public static function getType(): string;

    public static function getEntity(): string;

    public function handle(BaseField $field): void;
}
