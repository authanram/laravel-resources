@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

@if ($action->getFlashMessage())

    <div class="{{ $action->theme('flash.variants.theme.' . $action->getFlashMessage()->variant, 'flash.container') }}">

        <div class="{{ $action->theme('flash.message.container') }}">

            @icon() {{ $action->theme('flash.icon', 'flash.variants.icon.' . $action->getFlashMessage()->variant) }} @endicon

            <div class="{{ $action->theme('flash.message.text') }}">

                {!! $action->getFlashMessage()->highlight($action->theme('flash.highlight')) !!}

            </div>

        </div>

        @if ($action->getFlashMessage()->caption)

            <p class="{{ $action->theme('flash.caption') }}">

                {!! $action->getFlashMessage()->caption !!}

            </p>

        @endif

    </div>

@endif
