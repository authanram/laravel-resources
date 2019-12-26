<?php

namespace Authanram\Resources\Entities;

use Illuminate\Support\Collection;

class Action
{
    public const CREATE = 'create';

    public const EDIT = 'edit';

    public const DESTROY = 'destroy';

    public const INDEX = 'index';

    public const RESTORE = 'restore';

    public const SHOW = 'show';

    public const STORE = 'store';

    public const UPDATE = 'update';

    public static function getActions(): Collection
    {
        return collect([

            static::CREATE,

            static::EDIT,

            static::DESTROY,

            static::INDEX,

            static::RESTORE,

            static::SHOW,

            static::STORE,

            static::UPDATE,

        ]);
    }
}
