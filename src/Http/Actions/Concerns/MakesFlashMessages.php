<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Http\Request;
use Authanram\Resources\Entities\FlashMessage;
use Authanram\Resources\Http\Actions\Action;

trait MakesFlashMessages
{
    private function flashError(Action $action, Request $request): void
    {
        $variant = 'red';

        $name = strtolower($action->getResourceName());

        $message = 'PATCH' === $request->getMethod()

            ? __('%sFailed to update%s :name!', compact('name'))

            : __('%sFailed to create%s :name!', compact('name'));

        if (! $name) {

            $message = 'PATCH' === $request->getMethod()

                ? __('%sFailed to update%s!')

                : __('%sFailed to create%s!');

        }

        $caption = __('Please check your inputs and try again.');

        static::flash($request, $variant, $message, $caption);
    }

    private function flashSuccess(Action $action, Request $request): void
    {
        $variant = 'green';

        $name = $action->makeNameContinuousSingular();

        $message = 'PATCH' === $request->getMethod()

            ? __(':name %supdated%s!', compact('name'))

            : __(':name %screated%s!', compact('name'));

        if (! $name) {

            $message = 'PATCH' === $request->getMethod()

                ? __('%sUpdated%s!')

                : __('%sCreated%s!');

        }

        static::flash($request, $variant, $message);
    }

    private static function flash(Request $request, string $variant, string $message, string $caption = null): void
    {
        $flashMessage = FlashMessage::make($variant, $message, $caption);

        $request->session()->flash('message', $flashMessage);
    }
}
