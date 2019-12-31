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
            Actions\SetMetaFields::class,
            Actions\SetLengthAwarePaginator::class,
            Actions\SetInvokers::class,
        ],

        Action::SHOW => [
            Actions\SetMetaFields::class,
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
            Fields\Input\Boolean::class,
            Fields\Input\Json::class,
            Fields\Input\Text::class,
            Fields\Input\Timestamp::class,
            \Authanram\ResourcesFieldFroala\Plugins\Input::class,
        ],

        InteractionType::OUTPUT => [
            Fields\Output\BelongsToMany::class,
            Fields\Output\Boolean::class,
            Fields\Output\Id::class,
            Fields\Output\Json::class,
            Fields\Output\Text::class,
            Fields\Output\Timestamp::class,
            \Authanram\ResourcesFieldFroala\Plugins\Output::class,
        ],
    ]

];
