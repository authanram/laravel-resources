@php /** @var \Authanram\Resources\Entities\Fields\Output\Boolean $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<div
    class="{{ $action->theme(['resources.fields.types', 'boolean.container', 'boolean.variants.' . $field->getVariant()]) }}"
    style="{{ $action->theme('resources.fields.types.boolean.style') }}"
>

    {{ $field->getValue() ? 'true' : 'false' }}

</div>
