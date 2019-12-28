@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<textarea
    class="{{ $action->theme('form.fields.field.input') }}"

    name="{{ $field->getAttribute() }}"
>

    {{ $field->getValue() }}

</textarea>
