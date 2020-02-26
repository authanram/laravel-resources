@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<input-boolean
    :value="{{ $field->getValue() }}"
    label-false="{{ $field->getLabelFalse() }}"
    label-true="{{ $field->getLabelTrue() }}"
    name="{{ $field->getAttribute() }}"
></input-boolean>
