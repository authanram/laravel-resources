<?php

use Resources\Entities\Action;
use Resources\Entities\InteractionType;
use Resources\Plugins\Actions;
use Resources\Plugins\Fields;

return [

    'actions' => [
        'default' => [
            Actions\SetFields::class,
            Actions\SetFlashMessage::class,
            Actions\SetResourceName::class,
            Actions\SetBreadcrumbs::class,
        ],

        Action::CREATE => [],

        Action::EDIT => [],

        Action::INDEX => [
            Actions\SetLengthAwarePaginator::class,
        ],

        Action::SHOW => [],

        Action::DESTROY => [],

        Action::RESTORE => [],

        Action::STORE => [],

        Action::UPDATE => [],

    ],

    'fields' => [
        'default' => [
            Fields\SetClassAttribute::class,
            Fields\SetRawView::class,
        ],

        InteractionType::INPUT => [
            Fields\Input\BelongsToMany::class,
        ],

        InteractionType::OUTPUT => [
            Fields\Output\Timestamp::class,
        ],
    ]

];
