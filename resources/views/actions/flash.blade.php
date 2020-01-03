@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

@if ($action->getFlashMessage())

    <div class="{{ $action->theme(['resources.flash.variants.theme.' . $action->getFlashMessage()->variant, 'resources.flash.container']) }}">

        <div class="{{ $action->theme('resources.flash.message.container') }}">

            @php ($icon = 'resources.flash.variants.icon.' . $action->getFlashMessage()->variant)

            @if ($action->theme($icon, null, false))

                @icon() {{ $action->theme(['resources.flash.icon', $icon]) }} @endicon

            @endif

            <div class="{{ $action->theme('resources.flash.message.text') }}">

                {!! $action->getFlashMessage()->highlight($action->theme('resources.flash.highlight')) !!}

            </div>

        </div>

        @if ($action->getFlashMessage()->caption)

            <p class="{{ $action->theme('resources.flash.caption') }}">

                {!! $action->getFlashMessage()->caption !!}

            </p>

        @endif

    </div>

@endif
