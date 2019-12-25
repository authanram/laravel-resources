@php /** @var \Resources\Http\Actions\EditAction $action */ @endphp

<button
    class="{{ $action->theme('button.default', 'button.primary') }} mr-2"

    name="_action"

    type="submit"

    value="edit"
>

    {{ __('Update & Continue Editing') }}

</button>

<button
    class="{{ $action->theme('button.default', 'button.secondary') }}"

    type="submit"
>

    {{ __('Update') }} {{ $action->getResourceName() }}

</button>
