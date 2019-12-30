@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

@section ('styles')
@endsection

@section ('scripts')
@endsection

<textarea
    class="{{ $action->theme('form.fields.field.input') }}"

    name="{{ $field->getAttribute() }}"
>

    {{ $field->getValue() }}

</textarea>
