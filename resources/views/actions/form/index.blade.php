@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

<div class="{{ $action->theme('card') }}">

    @csrf

    @method ($action->getMethod())

    <div class="{{ $action->theme('padding') }}">

        @include ('authanram-resources::actions.form.fields')

        @include ($actions)

    </div>

</div>
