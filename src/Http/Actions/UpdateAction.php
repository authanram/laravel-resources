<?php

namespace Resources\Http\Actions;

use Resources\Entities;

final class UpdateAction extends StoreAction
{
    protected string $action = Entities\Action::UPDATE;
}
