@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<input
    class="{{ $action->theme('form.fields.field.input') }}"

    name="{{ $field->getAttribute() }}"

    type="text"

    value="{{ $field->getValue() }}"
>
