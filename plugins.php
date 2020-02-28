<?php

use Authanram\Resources\Entities\Action;
use Authanram\Resources\Entities\InteractionType;
use Authanram\Resources\Plugins\Actions;
use Authanram\Resources\Plugins\Fields;
use Authanram\Resources\Plugins\Raw;

return [

    'raw' => [
        Raw\ResourceFieldDefaults::class,
        Raw\ActionsCreateFieldDefaults::class,
        Raw\ActionsCreateValidatorDefaults::class,
        Raw\ActionsIndexAttributeDefaults::class,
        Raw\ActionsIndexFieldDefaults::class,
    ],

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
            Fields\Input\Text::class,
            Fields\Input\Timestamp::class,
            //
            \Authanram\ResourcesFieldBelongsTo\Plugins\Input::class,
            \Authanram\ResourcesFieldCode\Plugins\Input::class,
            \Authanram\ResourcesFieldFroala\Plugins\Input::class,
            \Authanram\ResourcesFieldTipTap\Plugins\Input::class,
        ],

        InteractionType::OUTPUT => [
            Fields\Output\BelongsToMany::class,
            Fields\Output\Boolean::class,
            Fields\Output\Id::class,
            Fields\Output\Text::class,
            Fields\Output\Timestamp::class,
            //
            \Authanram\ResourcesFieldBelongsTo\Plugins\Output::class,
            \Authanram\ResourcesFieldCode\Plugins\Output::class,
            \Authanram\ResourcesFieldFroala\Plugins\Output::class,
            \Authanram\ResourcesFieldTipTap\Plugins\Output::class,
        ],
    ]

];
