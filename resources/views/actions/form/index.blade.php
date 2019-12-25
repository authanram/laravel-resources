@php /** @var \Resources\Http\Actions\EditAction $action */ @endphp

<div class="{{ $action->theme('card') }}">

    @include ('resources::actions.flash')

    @csrf

    @method ($action->getMethod())

    <div class="{{ $action->theme('padding') }}">

        @include ('resources::actions.form.fields')

        @include ($actions)

    </div>

</div>
