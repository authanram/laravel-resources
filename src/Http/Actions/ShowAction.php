<?php

namespace Resources\Http\Actions;

use Resources\Entities;

final class ShowAction extends Action
{
    protected string $action = Entities\Action::INDEX;

    protected string $view = 'resources::actions.show.index';
}
