@php /** @var \Resources\Http\Actions\EditAction $action */ @endphp

@if ($action->getFlashMessage())

    <div class="{{ $action->getFlashMessage()->classAttribute }}">

        <p class="{{ $action->theme('flash.message') }}">

            {!! $action->getFlashMessage()->highlight() !!}

        </p>

        @if ($action->getFlashMessage()->caption)

            <p class="{{ $action->theme('flash.caption') }}">

                {!! $action->getFlashMessage()->caption !!}

            </p>

        @endif

    </div>

@endif
