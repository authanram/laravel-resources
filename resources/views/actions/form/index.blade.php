@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

<form
    action="{{ $postAction }}"

    method="POST"
>

    @csrf

    @method ($action->getMethod())

    <div class="{{ $action->theme('resources.form.container') }}">

        @include ('authanram-resources::actions.form.fields')

        @include ($buttonsView)

    </div>

</form>
