@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

<button
    class="{{ $action->theme('button.default', 'button.primary') }} mr-2"

    name="_action"

    type="submit"

    value="create"
>

    {{ __('Create & Add Another') }}

</button>

<button
    class="{{ $action->theme('button.default', 'button.secondary') }}"

    type="submit"
>

    {{ __('Create') }} {{ $action->getResourceName() }}

</button>
