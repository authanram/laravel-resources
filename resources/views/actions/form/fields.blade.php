@php /** @var \Resources\Http\Actions\EditAction $action */ @endphp
@php /** @var \Resources\Entities\Fields\BaseField $field */ @endphp

<div class="{{ $action->theme('form.fields.container') }}">

    @foreach ($action->getFields() as $field)

        <div class="{{ $field->getClass($action->theme('form.fields.field.container')) }}">

            @include ('resources::fields.input.field')

        </div>

    @endforeach

</div>
