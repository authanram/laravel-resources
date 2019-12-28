<?php

use Authanram\Resources\Entities\Action;
use Authanram\Resources\Entities\InteractionType;
use Authanram\Resources\Plugins\Actions;
use Authanram\Resources\Plugins\Fields;

return [

    'actions' => [
        'default' => [
            Actions\SetFields::class,
            Actions\SetFlashMessage::class,
            Actions\SetResourceName::class,
            Actions\SetBreadcrumbs::class,
        ],

        Action::CREATE => [],

        Action::EDIT => [
            Actions\SetInvokers::class,
        ],

        Action::INDEX => [
            Actions\SetLengthAwarePaginator::class,
            Actions\SetInvokers::class,
        ],

        Action::SHOW => [
            Actions\SetInvokers::class,
        ],

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
            Fields\Input\Froala::class,
        ],

        InteractionType::OUTPUT => [
            Fields\Output\Timestamp::class,
        ],
    ]

];
