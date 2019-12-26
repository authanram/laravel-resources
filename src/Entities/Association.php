<?php

namespace Authanram\Resources\Entities;

class Association
{
    public const BELONGS_TO = 'belongsTo';

    public const BELONGS_TO_MANY = 'belongsToMany';

    public const HAS_MANY = 'hasMany';

    public const HAS_MANY_THROUGH = 'hasManyThrough';

    public const HAS_ONE = 'hasOne';

    public const HAS_ONE_THROUGH = 'hasOneThrough';

    //

    public const TYPES = [

        self::BELONGS_TO,

        self::BELONGS_TO_MANY,

        self::HAS_MANY,

        self::HAS_MANY_THROUGH,

        self::HAS_ONE,

        self::HAS_ONE_THROUGH,

    ];

    public const TYPES_PIVOT = [

        self::BELONGS_TO_MANY,

    ];
}
