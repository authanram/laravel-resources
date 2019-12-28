@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

<button
    class="{{ $action->theme('buttons.accents.default', 'buttons.accents.primary') }} mr-2"

    name="_action"

    type="submit"

    value="edit"

    {{ $action->theme('buttons.directives') }}
>

    {{ __('Update & Continue Editing') }}

</button>

<button
    class="{{ $action->theme('buttons.accents.default', 'buttons.accents.secondary') }}"

    type="submit"

    {{ $action->theme('buttons.directives') }}
>

    {{ __('Update') }} {{ $action->getResourceName() }}

</button>
