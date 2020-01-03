@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

@if ($field->getError())

    <span class="{{ $action->theme('resources.form.fields.field.error') }}">

        {{ $field->getError() }}

    </span>

@endif
