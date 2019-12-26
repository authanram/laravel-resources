<?php

namespace Authanram\Resources\Plugins\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Entities\FlashMessage;
use Authanram\Resources\Http\Actions\Action;

final class SetFlashMessage implements ActionPluginContract
{
    public function handle(Action $action, Request $request): void
    {
        $message = Session::get('message');

        if (!$message instanceof FlashMessage) {

            return;

        }

        $action->setFlashMessage($message);
    }
}
