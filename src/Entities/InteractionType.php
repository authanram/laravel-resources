<?php

namespace Resources\Entities;

class InteractionType
{
    public const INPUT = 'input';

    public const OUTPUT = 'output';

    public static function makeInteractionType(string $action): ?string
    {
        $map = [

            Action::INDEX => static::OUTPUT,

            Action::SHOW => static::OUTPUT,

            Action::CREATE => static::INPUT,

            Action::EDIT => static::INPUT,

        ];

        return $map[$action] ?? null;
    }
}
