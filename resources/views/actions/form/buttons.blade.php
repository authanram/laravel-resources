@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

<button
    class="{{ $action->theme('buttons.button', 'buttons.size.md', 'buttons.accents.primary') }}"

    name="_action"

    type="submit"

    value="{{ $primary['value'] }}"

    {{ $action->theme('buttons.directives') }}
>

    {{ $primary['label'] }}

</button>

<button
    class="{{ $action->theme('buttons.button', 'buttons.size.md', 'buttons.accents.secondary') }}"

    type="submit"

    {{ $action->theme('buttons.directives') }}
>

    {{ $secondary['label'] }}

</button>
