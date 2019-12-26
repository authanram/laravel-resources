<?php

namespace Authanram\Resources\Http\Actions;

use Authanram\Resources\Entities;

final class EditAction extends Action
{
    protected string $action = Entities\Action::EDIT;

    protected string $method = 'PATCH';

    protected string $view = 'authanram-resources::actions.edit.index';
}
