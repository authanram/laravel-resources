<?php

namespace Resources\Http\Actions;

use Resources\Entities;

final class CreateAction extends Action
{
    protected string $action = Entities\Action::CREATE;

    protected string $method = 'POST';

    protected string $view = 'authanram-resources::actions.create.index';
}
