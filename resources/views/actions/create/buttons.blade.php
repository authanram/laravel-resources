@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

<button
    class="{{ $action->theme('buttons.accents.default', 'buttons.accents.primary') }} mr-2"

    name="_action"

    type="submit"

    value="create"

    {{ $action->theme('buttons.directives') }}
>

    {{ __('Create & Add Another') }}

</button>

<button
    class="{{ $action->theme('buttons.accents.default', 'buttons.accents.secondary') }}"

    type="submit"

    {{ $action->theme('buttons.directives') }}
>

    {{ __('Create') }} {{ $action->getResourceName() }}

</button>
