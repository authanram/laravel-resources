@php /** @var \Authanram\Resources\Entities\Fields\Output\BelongsTo $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<p class="{{ $action->theme('resources.fields.default') }}">

    {{ $field->getValue() }}

</p>
