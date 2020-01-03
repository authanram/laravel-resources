@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

<button
    class="{{ $action->theme(['resources.buttons', 'group', 'button', 'size.md', 'variants.primary']) }}"

    name="_action"

    type="submit"

    value="{{ $primary['value'] }}"

    {{ $attributes ?? '' }}
>

    {{ $primary['label'] }}

</button>

<span class="{{ $action->theme(['resources.spacer', 'inline', 'default']) }}"></span>

<button
    class="{{ $action->theme(['resources.buttons', 'group', 'button', 'size.md', 'variants.secondary']) }}"

    type="submit"

    {{ $attributes ?? '' }}
>

    {{ $secondary['label'] }}

</button>
