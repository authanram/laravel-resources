<?php

namespace Authanram\Resources\Http\Actions;

use Authanram\Resources\Entities;

final class UpdateAction extends StoreAction
{
    protected string $action = Entities\Action::UPDATE;
}
