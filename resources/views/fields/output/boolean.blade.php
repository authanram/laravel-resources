@php /** @var \Authanram\Resources\Entities\Fields\Output\BooleanEntity $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<span
    class="{{ $action->theme('fields.boolean.container', 'fields.boolean.variants.' . $field->getVariant()) }}"
    style="min-width:42px;"
>

    {{ $field->getValue() ? 'true' : 'false' }}

</span>
