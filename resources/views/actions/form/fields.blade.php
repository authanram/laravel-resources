@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<div class="{{ $action->theme('resources.form.fields.container') }}">

    @foreach ($action->getFields() as $field)

        <div class="{{ $field->getClass($action->getAction(), $action->theme('resources.form.fields.field.container')) }}">

            @include ('authanram-resources::fields.input.field')

        </div>

    @endforeach

</div>
