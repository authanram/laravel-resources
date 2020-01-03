@php /** @var \Authanram\Resources\Entities\Fields\Output\Boolean $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<div
    class="{{ $action->theme(['resources.fields.boolean.container', 'resources.fields.boolean.variants.' . $field->getVariant()]) }}"
    style="{{ $action->theme('resources.fields.boolean.style') }}"
>

    <div>

        {{ $field->getValue() ? 'true' : 'false' }}

    </div>

</div>
