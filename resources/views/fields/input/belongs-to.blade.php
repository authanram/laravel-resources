@php /** @var \Authanram\Resources\Entities\Fields\Input\BelongsTo $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<input
    class="{{ $action->theme('resources.form.fields.field.input') }}"

    name="{{ $field->getAttribute() }}"

    type="text"

    value="{{ $field->getValue() }}"
>
