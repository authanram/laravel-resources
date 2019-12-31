<?php

namespace Authanram\Resources\Http\Actions;

use Authanram\Resources\Entities;

final class ShowAction extends Action
{
    protected string $action = Entities\Action::SHOW;

    protected string $view = 'authanram-resources::actions.show.index';
}
