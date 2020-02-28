@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<input-boolean
    :value="{{ $field->getValue() }}"
    label-false="{{ $field->getLabelFalse() }}"
    label-true="{{ $field->getLabelTrue() }}"
    name="{{ $field->getAttribute() }}"
></input-boolean>
